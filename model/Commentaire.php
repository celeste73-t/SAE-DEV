<?php
namespace model;

// Importation des dépendances
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Post.php';

class Commentaire {
    private ?int $id;
    private string $contenu;

    public function __construct(?int $id, string $contenu) {
        $this->id = $id;
        $this->contenu = $contenu;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getContenu(): string {
        return $this->contenu;
    }
}
