<?php
namespace dao;

use service\ConnectionBDD;
use PDO;
use PDOException;


class ConstanteDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }
    
    /**
     * Récupère toutes les données de la table 'constante'.
     * @return array Les données de la table ou un tableau vide.
     */
    public function getConstanteDate(): array {
        try {
            // Utilisation de query() car la requête ne contient pas de variables.
            $query = $this->db->query("SELECT * FROM constante");
            $constante_date = $query->fetchAll(PDO::FETCH_ASSOC); 
            return $constante_date;
            
        } catch (PDOException $e) {
            error_log("Erreur dans ConstanteDAO::getConstanteDate : " . $e->getMessage());
            return [];
        }
    }

    
}
?>