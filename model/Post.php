<?php
namespace model;

// Importation des dépendances
require_once __DIR__ . '/User.php';

/**
 * Cette classe représente une publication (Post) générale, 
 * basée sur la référence 'postId' trouvée dans la table 'commentaire'.
 * (Structure déduite)
 */
class Post {
    private ?int $id;
    private string $titre;
    private string $contenu;

    public function __construct(?int $id, string $titre, string $contenu) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getContenu(): string {
        return $this->contenu;
    }
}
