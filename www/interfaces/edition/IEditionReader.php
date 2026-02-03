<?php
namespace interfaces\edition;

require_once 'model/Edition.php';

use model\Edition;

interface IEditionReader {
    public function getActive(): Edition;
    public function getEditions(): array;
    public function categorieInActiveEdition(int $categorieId): bool;
}