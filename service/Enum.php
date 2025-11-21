<?php
namespace service;

enum UserRole: int {
    case Visiteur = 0;
    case User = 1;
    case Candidat = 2;
    case Admin = 3;
}

enum PhaseVote: int {
    case PreVote = 0;
    case Vote1 = 1;
    case Vote2 = 2;
    case Resultats = 3;
}

?>