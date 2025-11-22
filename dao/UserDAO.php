<?php
namespace dao;

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

class UserDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }

    public function findByEmail(string $email): ?User {
        try {
            $query = "SELECT * FROM utilisateur WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$data) {
                return null;
            }
            
            return new User(
                $data['id'],
                $data['email'],
                $data['pseudo'],
                $data['password'],
                $data['role']
            );
            
        } catch (PDOException $e) {
            error_log("Erreur dans UserDAO::findByEmail : " . $e->getMessage());
            return null;
        }
    }
}
?>