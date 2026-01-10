<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../service/Enum.php';

use dao\DAO;
use PDO;
use model\User;

class UserDAO extends DAO {
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

    public function newUser(User $user): bool {
        try {
            $query = "INSERT INTO Utilisateur (nom, email, motDePasse, userType) VALUES (:nom, :email, :mdp, :type)";
            $stmt = $this->db->prepare($query);
            
            $nom = $user->getNom();
            $email = $user->getEmail();
            $mdp = $user->getPassword();
            // Utilise la valeur raw de l'Enum pour l'insertion en BDD (PHP 8.1+)
            $userType = $user->getRole()->value; 
            
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->bindParam(':type', $userType);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erreur dans UserDAO::save : " . $e->getMessage());
            return false;
        }
    }
}
?>