<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';

use dao\DAO;
use PDO;
use PDOException;

class ConstanteDAO extends DAO {
    /**
     * Récupère toutes les données de la table 'constante'.
     * @return array Les données de la table ou un tableau vide.
     */
    public function readAll(): array {
        try {
            $query = $this->db->query("SELECT * FROM constantes");
            $constantes = $query->fetch(PDO::FETCH_ASSOC);
            return $constantes ?: []; // retourne tableau vide si rien
        } catch (PDOException $e) {
            error_log("Erreur dans ConstanteDAO::readAll : " . $e->getMessage());
            return [];
        }
    }
}
