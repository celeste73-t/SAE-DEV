<?php
namespace dao;

require_once 'service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;

abstract class DAO {
    protected PDO $db;

    /**
     * Initialise le DAO avec l'objet de connexion PDO.
     * @param PDO $db L'objet de connexion à la base de données.
     */
    public function __construct() {
        // Injection de la dépendance PDO
        $this->db = ConnectionBDD::connect();
    }
}
