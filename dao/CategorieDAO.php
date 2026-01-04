<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';
require_once __DIR__ . '/../model/Categorie.php';

use service\ConnectionBDD;
use model\Categorie;
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
            $rows = $query->fetchAll(PDO::FETCH_ASSOC); 
            
            foreach ($rows as $row) { 
                $categories[] = Categorie::fromDatabaseArray($row); 
            } 
            return $categories;
            
        } catch (PDOException $e) {
            error_log("Erreur dans CategorieDAO::getAllCategories : " . $e->getMessage());
            return [];
        }
    }
    
}
?>