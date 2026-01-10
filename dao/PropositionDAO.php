<?php
namespace dao;

require_once __DIR__ . '/../dao/DAO.php';
require_once __DIR__ . '/../model/PropositionItem.php';
require_once __DIR__ . '/../service/Enum.php';

use dao\DAO;
use PDO;
use model\PropositionItem;
use service\CategorieType;

class PropositionDAO extends DAO {
    private function findItem(int $deezerId, CategorieType $type): ?array {
        $sql = "SELECT * FROM proposition_item WHERE deezerId = ? AND type = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$deezerId, $type]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function createItem(PropositionItem $proposition): void {
        $sql = "INSERT INTO proposition_item (deezerId, titre, artist, image, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$proposition->getIdDeezer(),
                        $proposition->getTitre(), 
                        $proposition->getArtiste(), 
                        $proposition->getImage(), 
                        $proposition->getType()]);
        return;
    }

    public function addProposition(PropositionItem $proposition, int $categorieId): void {
        $item = $this->findItem($proposition->getIdDeezer(),
                                $proposition->getType());
        if ($item) {
            $itemId = $item['id'];
        } else {
            $itemId = $this->createItem($proposition, $type);
        }

        $sql = "INSERT INTO proposition (itemId, categorieId, dateProposition) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$itemId, $categorieId, date('Y-m-d H:i:s')]);

        return;
    }

    public function getNominatedPropositions($categorieId): array {
        $sql = "SELECT itemId, COUNT(*) AS nb 
                FROM proposition 
                WHERE categorieId = ? 
                GROUP BY itemId 
                ORDER BY nb DESC 
                LIMIT 5 ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categorieId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($rows as $row) {
            $sqlItem = "SELECT * FROM proposition_item WHERE id = ?"; 
            $stmtItem = $this->db->prepare($sqlItem); 
            $stmtItem->execute([$row['itemId']]); 
            $itemData = $stmtItem->fetch(PDO::FETCH_ASSOC);

            if ($itemData) {
                $items[] = [
                    'proposition' => new PropositionItem(
                        $itemData['deezerId'],
                        $itemData['type'],
                        $itemData['titre'],
                        $itemData['artist'],
                        $itemData['image']
                    ),
                    'nb' => $row['nb']
                ];
            }
        }
        return $items;
    }
}
