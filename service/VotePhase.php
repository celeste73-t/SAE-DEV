<?php
namespace service;

require_once __DIR__ . '/dao/ConstanteDAO.php';
use dao\ConstanteDAO;

class VotePhase {
    // Utilise ConstanteDAO pour récupérer les dates
    // Compare à la date actuelle
    // Renvoie la phase de vote
    public function getPhaseVote(){
        $dao = new ConstanteDAO();
        $dao.readAll()
    }
}
?>