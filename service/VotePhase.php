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

        $startPremierTour = new \DateTime($constante["startPremierTour"]);
        $startSecondTour = new \DateTime($constante["startSecondTour"]);
        $endSecondTour = new \DateTime($constante["endSecondTour"]);

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