<?php
namespace interfaces\categorie;

require_once 'model/Categorie.php';

use model\Categorie;

interface ICategorieReader {
    public function findById(int $id): ?Categorie;
    public function getCategoriesFromEdition(int $editionId): array;
}