<?php
namespace service;

enum UserRole: string {
    case Visiteur = 'visiteur';
    case User = 'votant';
    case Candidat = 'candidat';
    case Admin = 'administrateur';
}

enum PhaseVote: int {
    case PreVote = 0;
    case Vote1 = 1;
    case Vote2 = 2;
    case Resultats = 3;
}

?>