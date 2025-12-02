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
    private int $id;
    private string $titre;
    private string $contenu;
    private User $auteur; // L'utilisateur qui a créé le post

    public function __construct(int $id, string $titre, string $contenu, User $auteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->auteur = $auteur;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getContenu(): string {
        return $this->contenu;
    }

    public function getAuteur(): User {
        return $this->auteur;
    }

    // Setters
    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function setContenu(string $contenu): void {
        $this->contenu = $contenu;
    }

    public function setAuteur(User $auteur): void {
        $this->auteur = $auteur;
    }
}
?>