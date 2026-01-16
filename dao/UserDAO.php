<?php
namespace dao;

require_once 'dao/DAO.php';
require_once 'model/User.php';
require_once 'service/Enum.php';
require_once 'interfaces/user/IUserReader.php';
require_once 'interfaces/user/IUserWriter.php';

use dao\DAO;
use interfaces\user\IUserReader;
use interfaces\user\IUserWriter;
use PDO;
use PDOException;
use model\User;
use service\UserRole;

class UserDAO extends DAO implements IUserReader, IUserWriter {
    
    // Read

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
            
            $id = (int)$data['id'];
            $role = match($data['userType']) {
                'votant' => UserRole::User,
                'administrateur' => UserRole::Admin,
                default => UserRole::User
            };

            if ($this->isCandidat($id)) {
                $role = UserRole::Candidat;
            }

            return new User(
                $id,
                $data['email'],
                $data['nom'],
                $data['motDePasse'],
                $role
            );
        } catch (PDOException $e) {
            error_log("Erreur dans UserDAO::findByEmail : " . $e->getMessage());
            // En cas d'erreur de base de données, retourne null
            return null;
        }
    }

    // Write

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

    // Private

    private function isCandidat(int $userId): bool {
        $query = $this->db->prepare("SELECT 1 FROM candidat WHERE utilisateurId = :id LIMIT 1");
        $query->bindParam(':id', $userId);
        $query->execute();
        return (bool) $query->fetchColumn();
    }
}
