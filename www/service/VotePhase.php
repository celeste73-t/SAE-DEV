<?php
namespace service;

require_once 'dao/EditionDAO.php';
require_once 'service/Enum.php';

use dao\EditionDAO;
use DateTime;

class VotePhase {
    // Utilise EditionDAO pour récupérer les dates
    // Compare à la date actuelle
    // Renvoie la phase de vote
    public static function getPhaseVote(){
        $dao = new EditionDAO();
        $edition = $dao->getActive();

        $now = new DateTime();

        if($now < $edition->getDebutNomination()) {
            return PhaseVote::PreVote;
        } elseif($now < $edition->getDebutVote()) {
            return PhaseVote::Vote1;
        } elseif($now < $edition->getDebutResultat()) {
            return PhaseVote::Vote2;
        } else {
            return PhaseVote::Resultats;
        }
    }
}
