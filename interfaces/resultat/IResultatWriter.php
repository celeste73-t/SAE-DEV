<?php
namespace interfaces\resultat;

require_once 'model/Resultat.php';

use model\Resultat;

interface IResultatWriter {
    public function archiveResultat(Resultat $resultat, int $categorieId, int $editionId): int;
}