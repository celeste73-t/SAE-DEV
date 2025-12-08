<?php
namespace dao;

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../service/Enum.php';
require_once __DIR__ . '/../service/ConnectionBDD.php';

use PDO;
use PDOException;
use model\User;

class UserDAO {
    private PDO $db;

    /**
     * Initialise le DAO avec l'objet de connexion PDO.
     * @param PDO $db L'objet de connexion à la base de données.
     */
    public function __construct(PDO $db) {
        // Injection de la dépendance PDO
        $this->db = $db;
    }

    /**
     * Recherche un utilisateur par son adresse email.
     * @param string $email L'adresse email de l'utilisateur à rechercher.
     * @return User|null L'objet User s'il est trouvé, sinon null.
     */
    public function findByEmail(string $email): ?User {
        try {
            // On prépare la requête pour éviter les injections SQL
            $query = "SELECT id, email, nom, motDePasse, userType FROM utilisateur WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$data) {
                return null;
            }

            // Utilise la méthode statique d'hydratation de la classe User (recommandé)
            return User::fromDatabaseArray($data);
            
        } catch (PDOException $e) {
            error_log("Erreur dans UserDAO::findByEmail : " . $e->getMessage());
            // En cas d'erreur de base de données, retourne null
            return null;
        }
    }
}
?>