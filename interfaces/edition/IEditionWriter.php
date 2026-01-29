<?php
namespace interfaces\edition;

require_once 'model/Edition.php';

use model\Edition;

interface IEditionWriter {
    public function createEdition(Edition $edition): void;
    public function updateEdition(int $id, Edition $edition): void;
    public function deleteEdition(int $id): void;

}