<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Categorie.php';

use dao\DAO;
use PDO;
use PDOException;
use model\Categorie;

class CategorieDAO extends DAO {
    public function findById(int $id): ?Categorie {
        try {
            $query = "SELECT * FROM categorie WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$data) {
                return null;
            }

            // Utilise la méthode statique d'hydratation de la classe Categorie (recommandé)
            return Categorie::fromDatabaseArray($data);
            
        } catch (PDOException $e) {
            error_log("Erreur dans CategorieDAO::findById : " . $e->getMessage());
            return null;
        }
    }
    
    public function getAllCategories(): array {
        try {
            $query = $this->db->query("SELECT * FROM categorie");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

            $categories = [];
            foreach ($rows as $row) {
                $categories[] = Categorie::fromDatabaseArray($row);
            }

            return $categories;

        } catch (PDOException $e) {
            error_log("Erreur dans CategorieDAO::getAllCategories : " . $e->getMessage());
            return [];
        }
    }

    public function getCategoriesForEdition(int $editionId): array {
        try {
            $sql = "SELECT c.* 
                    FROM categorie c 
                    JOIN edition_categorie ec ON ec.categorieId = c.id 
                    WHERE ec.editionId = ?"; 
            $stmt = $this->db->prepare($sql); 
            $stmt->execute([$editionId]); 
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $categories = [];
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
