<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Edition.php';
require_once 'interfaces/edition/IEditionReader.php';

use dao\DAO;
use PDO;
use Exception;
use model\Edition;
use DateTime;
use interfaces\edition\IEditionReader;

class EditionDAO extends DAO implements IEditionReader {
    
    // Read

    public function getActive(): Edition {
        try {
            $query = $this->db->query("SELECT * FROM edition WHERE active = 1");
            $editions = $query->fetchAll(PDO::FETCH_ASSOC);

            // Aucune édition active
            if (count($editions) === 0) {
                throw new Exception("Aucune édition active n'est définie.");
            }

            // Plus d'une édition active → erreur grave
            if (count($editions) > 1) {
                throw new Exception("Plusieurs éditions actives détectées. L'état du système est invalide.");
            }

            // Une seule édition active → OK
            $e = $editions[0];

            return new Edition(
                $e["id"],
                $e["nom"],
                (new DateTime($e["debutNomination"])),
                (new DateTime($e["debutVote"])),
                (new DateTime($e["debutResultat"])),
                $e["active"]
            );

        } catch (Exception $e) {
            error_log("Erreur dans EditionDAO::getActive : " . $e->getMessage());
            throw $e;
        }
    }

    public function categorieInActiveEdition(int $categorieId): bool { 
        $sql = "SELECT 1 
                FROM edition_categorie 
                WHERE categorieId = ? AND editionId = ? 
                LIMIT 1"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$categorieId, $this->getActive()->getId()]); 
        
        return (bool) $stmt->fetchColumn(); 
    }
}