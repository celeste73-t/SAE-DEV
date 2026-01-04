<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

class CategorieDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }
    
    public function getAllCategories(): array {
        try {
            $query = $this->db->query("SELECT * FROM categorie");
            $categories = $query->fetchAll(PDO::FETCH_ASSOC); 
            return $categories;
            
        } catch (PDOException $e) {
            error_log("Erreur dans CategorieDAO::getAllCategories : " . $e->getMessage());
            return [];
        }
    }
    
}
?>