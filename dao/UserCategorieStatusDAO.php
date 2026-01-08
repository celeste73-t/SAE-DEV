<?php
namespace dao;

require_once __DIR__ . '/../service/ConnectionBDD.php';

use service\ConnectionBDD;
use PDO;
use PDOException;

class UserCategorieStatusDAO {
    private PDO $db;

    public function __construct() {
        // Injection de la dépendance PDO en utilisant la méthode statique connect()
        $this->db = ConnectionBDD::connect();
    }

    public function findStatusByUserAndCategorie($userId, $categorieId) {
        $sql = "SELECT status FROM user_categorie_status WHERE user_id = ? AND categorie_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $categorieId]);
        return $stmt->fetchColumn();
    }

    public function insert($userId, $categorieId, $status) {
        $sql = "INSERT INTO user_categorie_status (user_id, categorie_id, status) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $categorieId, $status]);
    }
}
?>