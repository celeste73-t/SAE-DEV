<?php
namespace service;

use PDO;
use PDOException; 

/**
 * Classe de service pour établir la connexion à la base de données.
 */
class ConnectionBDD {
    
    /**
     * Établit et retourne la connexion PDO.
     * @return PDO L'objet de connexion à la base de données.
     */
    public static function connect(): PDO {
        try {
            # TODO: Faire Une connexion sécuriser
            $dsn = 'mysql:host=localhost;dbname=bdd_sae;charset=utf8;port=3306';
            $username = 'admin';
            $password = 'mdp_admin'; 

            $db = new PDO(
                $dsn, 
                $username, 
                $password
            );

            // Configuration des options PDO pour une meilleure gestion des erreurs
            // Ceci permet à PDO de lancer des exceptions en cas d'erreur SQL, au lieu de retourner false.
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Retourne l'objet de connexion
            return $db;

        } catch (PDOException $e) {
            die('Erreur de connexion à la BDD : ' . $e->getMessage());
        }
    }
}
?>