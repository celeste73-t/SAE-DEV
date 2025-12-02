<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

class PropositionDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }
    
}
?>