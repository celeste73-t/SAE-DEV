<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Categorie.php';
require_once 'interfaces/categorie/ICategorieReader.php';

use dao\DAO;
use PDO;
use PDOException;
use model\Categorie;
use interfaces\categorie\ICategorieReader;

class CategorieDAO extends DAO implements ICategorieReader{

    // Read

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

    public function getCategoriesFromEdition(int $editionId): array {
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
