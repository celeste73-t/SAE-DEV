<?php
namespace interfaces\resultat;

interface IResultatReader {
    public function getResultat(int $categorieId) : array;
}