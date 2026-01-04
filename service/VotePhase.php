<?php
namespace service;

require_once __DIR__ . '/../dao/ConstanteDAO.php';
require_once __DIR__ . '/Enum.php';
use dao\ConstanteDAO;

class VotePhase {
    // Utilise ConstanteDAO pour récupérer les dates
    // Compare à la date actuelle
    // Renvoie la phase de vote
    public function getPhaseVote(){
        $dao = new ConstanteDAO();
        $constante = $dao->readAll();

        $now = new \DateTime();

        if (!isset($constante["startPremierTour"], $constante["startSecondTour"], $constante["endSecondTour"])) {
            // Valeurs manquantes → retourne PreVote par défaut ou lève une exception
            error_log("Constantes manquantes pour calculer la phase de vote");
            return PhaseVote::PreVote;
        }

        $startPremierTour = new \DateTime($constante["startPremierTour"]);
        $startSecondTour = new \DateTime($constante["startSecondTour"]);
        $endSecondTour = new \DateTime($constante["endSecondTour"]);

        error_log("Now = " . $now->format('Y-m-d H:i:s'));
error_log("Premier tour = " . $startPremierTour->format('Y-m-d H:i:s'));
error_log("Second tour = " . $startSecondTour->format('Y-m-d H:i:s'));
error_log("Fin second tour = " . $endSecondTour->format('Y-m-d H:i:s'));

        if($now < $startPremierTour) {
            return PhaseVote::PreVote;
        } elseif($now < $startSecondTour) {
            return PhaseVote::Vote1;
        } elseif($now < $endSecondTour) {
            return PhaseVote::Vote2;
        } else {
            return PhaseVote::Resultats;
        }
    }
}
?>