<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

abstract class DAO {
    private PDO $db;

    /**
     * Initialise le DAO avec l'objet de connexion PDO.
     * @param PDO $db L'objet de connexion à la base de données.
     */
    public function __construct() {
        // Injection de la dépendance PDO
        $this->db = ConnectionBDD::connect();
    }
}
