<?php
namespace service;

enum UserRole: string {
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

enum CategorieType: string {
    case Track = 'track';
    case Album = 'album';
    case Artist = 'artist';
}
?>