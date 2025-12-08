<?php
namespace service;

enum UserRole: string {
    case Visiteur = 'visiteur';
    case User = 'votant';
    case Candidat = 'candidat';
    case Admin = 'administrateur';
}
?>