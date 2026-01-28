<?php
namespace controller;

require_once 'controller/composant/BlocPropositionController.php';
require_once 'controller/composant/BlocInteractionController.php';
require_once 'vue/page/PageValidation.php';
require_once 'service/SessionManager.php';
require_once 'service/Enum.php';
require_once 'service/VotePhase.php';
require_once 'interfaces/categorie/ICategorieReader.php';
require_once 'interfaces/proposition/IPropositionWriter.php';
require_once 'interfaces/proposition/IPropositionReader.php';
require_once 'interfaces/post/IPostReader.php';
require_once 'interfaces/post/IPostWriter.php';
require_once 'interfaces/commentaire/ICommentaireReader.php';
require_once 'interfaces/commentaire/ICommentaireWriter.php';
require_once 'interfaces/userCategorieStatus/IUserCategorieStatusReader.php';
require_once 'interfaces/userCategorieStatus/IUserCategorieStatusWriter.php';
require_once 'interfaces/edition/IEditionReader.php';
require_once 'interfaces/vote/IVoteWriter.php';

use controller\composant\BlocPropositionController;
use controller\composant\BlocInteractionController;
use vue\page\PageValidation;
use service\SessionManager;
use service\UserRole;
use service\VotePhase;
use service\PhaseVote;
use interfaces\categorie\ICategorieReader;
use interfaces\proposition\IPropositionReader;
use interfaces\proposition\IPropositionWriter;
use interfaces\post\IPostReader;
use interfaces\post\IPostWriter;
use interfaces\commentaire\ICommentaireReader;
use interfaces\commentaire\ICommentaireWriter;
use interfaces\userCategorieStatus\IUserCategorieStatusReader;
use interfaces\userCategorieStatus\IUserCategorieStatusWriter;
use interfaces\edition\IEditionReader;
use interfaces\vote\IVoteWriter;

class ValidationController {
    private ICategorieReader $categorieReader;
    private IPropositionReader $propositionReader;
    private IPropositionWriter $propositionWriter;
    private IPostReader $postReader;
    private IPostWriter $postWriter;
    private ICommentaireReader $commentaireReader;
    private ICommentaireWriter $commentaireWriter;
    private IUserCategorieStatusReader $userCategorieStatusReader;
    private IUserCategorieStatusWriter $userCategorieStatusWriter;
    private IEditionReader $editionReader;
    private IVoteWriter $voteWriter;

    public function __construct(ICategorieReader $categorieReader, IPropositionReader $propositionReader, IPropositionWriter $propositionWriter, IPostReader $postReader, IPostWriter $postWriter, ICommentaireReader $commentaireReader, ICommentaireWriter $commentaireWriter, IUserCategorieStatusReader $userCategorieStatusReader, IUserCategorieStatusWriter $userCategorieStatusWriter, IEditionReader $editionReader, IVoteWriter $voteWriter) {
        $this->categorieReader = $categorieReader;
        $this->propositionReader = $propositionReader;
        $this->propositionWriter = $propositionWriter;
        $this->postReader = $postReader;
        $this->postWriter = $postWriter;
        $this->commentaireReader = $commentaireReader;
        $this->commentaireWriter = $commentaireWriter;
        $this->userCategorieStatusReader = $userCategorieStatusReader;
        $this->userCategorieStatusWriter = $userCategorieStatusWriter;
        $this->editionReader = $editionReader;
        $this->voteWriter = $voteWriter;
    }


    public function index() {
        $categorieId = $_SESSION['categorieId'] ?? null;

        $categorie = $this->categorieReader->findById($categorieId);

        if (!isset($_SESSION['proposition'])) { 
            echo "Aucune proposition sélectionnée"; 
            exit; 
        }
        $proposition = unserialize($_SESSION['proposition']);

        $phase = VotePhase::getPhaseVote();

        $blocPropositionController = new BlocPropositionController($proposition, $categorie);
        $blocProposition = $blocPropositionController->build();

        if (VotePhase::getPhaseVote() == PhaseVote::Vote2) {
            $item = $this->propositionReader->findItem($proposition->getIdDeezer());

            $blocInteractionController = new BlocInteractionController($this->postReader, $this->postWriter, $this->commentaireReader, $this->commentaireWriter, $item['id']);
            $blocInteraction = $blocInteractionController->build();

            $page = new PageValidation("Validation", $blocProposition, $blocInteraction, $categorie, $phase);
        } else {
            $page = new PageValidation("Validation", $blocProposition, null, $categorie, $phase);
        }
        
        $page->render(); // le contrôleur déclenche l’affichage
    }

    public function validate() {
        $session = SessionManager::getInstance();
        if (!$session->isLogged()) {
            $session->setErrorMessage("Vous devez être connecté pour valider une proposition.");
            header('Location: index.php?page=connexion');
            exit;
        }

        $user = $session->getUser();
        if ($user->getRole() !== UserRole::User) {
            $session->setErrorMessage("Veuillez vous connecter en tant qu'utilisateur pour valider une proposition.");
            header('Location: index.php?page=accueil');
            exit;
        }

        $phase = VotePhase::getPhaseVote();
        if ($phase == PhaseVote::Vote1) {
            $this->validateProposition($user, $session);
        } else if ($phase == PhaseVote::Vote2) {
            $this->validateVote($user, $session);
        } else {
            $session->setErrorMessage("La validation n'est pas autorisée pendant cette phase.");
            header('Location: index.php?page=accueil');
            exit;
        }
    }

    private function validateProposition($user, $session) {
        
        $categorieId = $_SESSION['categorieId'];
        if ($this->userCategorieStatusReader->getPropositionStatus($user->getId(), $categorieId)) { 
            $session->setErrorMessage("Vous avez déjà proposé dans cette catégorie."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }

        if (!$this->editionReader->categorieInActiveEdition($categorieId)) {
            $session->setErrorMessage("Cette catégorie n'est pas actuellement disponible."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }


        $proposition = unserialize($_SESSION['proposition']);

        $this->propositionWriter->addProposition($proposition, $categorieId);

        $this->userCategorieStatusWriter->setPropositionStatus($user->getId(), $categorieId);

        $session->setSuccessMessage("Votre proposition a été prise en compte.");

        header('Location: index.php?page=accueil');
        exit();
    }

    private function validateVote($user, $session) {
        
        $categorieId = $_SESSION['categorieId'];
        if ($this->userCategorieStatusReader->getVoteStatus($user->getId(), $categorieId)) { 
            $session->setErrorMessage("Vous avez déjà voté dans cette catégorie."); 
            header("Location: index.php?page=accueil"); 
            exit; 
        }

        // Envoyer le vote à la base de données
        $proposition = unserialize($_SESSION['proposition']);
        
        $this->voteWriter->addVote($proposition);

        $this->userCategorieStatusWriter->setVoteStatus($user->getId(), $categorieId);

        $session->setSuccessMessage("Votre vote a été pris en compte.");

        header('Location: index.php?page=accueil');
        exit();
    }
}
