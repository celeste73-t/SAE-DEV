<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/Edition.php';
require_once 'interfaces/edition/IEditionReader.php';
require_once 'interfaces/edition/IEditionWriter.php';

use dao\DAO;
use PDO;
use Exception;
use model\Edition;
use DateTime;
use interfaces\edition\IEditionReader;
use interfaces\edition\IEditionWriter;

class EditionDAO extends DAO implements IEditionReader, IEditionWriter {
    
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

    public function getEditions(): array { 
        $query = $this->db->query("SELECT * FROM edition ORDER BY id ASC"); 
        $rows = $query->fetchAll(PDO::FETCH_ASSOC); 
        $editions = []; 
        
        foreach ($rows as $e) { 
            $editions[] = new Edition(
                $e["id"],
                $e["nom"],
                (new DateTime($e["debutNomination"])),
                (new DateTime($e["debutVote"])),
                (new DateTime($e["debutResultat"])),
                (bool)$e["active"]
            ); 
        }
        return $editions; 
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

    // Write

    public function createEdition(Edition $edition): void {
        $this->db->exec("UPDATE edition SET active = 0");

        $sql = "INSERT INTO edition (nom, debutNomination, debutVote, debutResultat, active)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $edition->getNom(),
            $edition->getDebutNomination()->format("Y-m-d"),
            $edition->getDebutVote()->format("Y-m-d"),
            $edition->getDebutResultat()->format("Y-m-d"),
            $edition->isActive() ? 1 : 0
        ]);
    }

    public function updateEdition(int $id, Edition $edition): void { 
        $this->db->exec("UPDATE edition SET active = 0");

        $sql = "UPDATE edition 
                SET nom = ?, debutNomination = ?, debutVote = ?, debutResultat = ?, active = ? 
                WHERE id = ?"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([ 
            $edition->getNom(), 
            $edition->getDebutNomination()->format("Y-m-d"), 
            $edition->getDebutVote()->format("Y-m-d"), 
            $edition->getDebutResultat()->format("Y-m-d"), 
            $edition->isActive() ? 1 : 0, 
            $id
        ]);
    }

    public function deleteEdition(int $id): void {
        $sql = "DELETE FROM edition WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }

}