<?php
namespace model;

// Importation des dépendances
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Post.php';

class Commentaire {
    private int $id;
    private string $contenu;
    private User $auteur; // L'utilisateur (votant, admin, candidat) qui a commenté
    private Post $post; // La publication à laquelle le commentaire est lié
    private ?Commentaire $parentCommentaire; // Pour les réponses, peut être null

    public function __construct(int $id, string $contenu, User $auteur, Post $post, ?Commentaire $parentCommentaire = null) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->auteur = $auteur;
        $this->post = $post;
        $this->parentCommentaire = $parentCommentaire;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getContenu(): string {
        return $this->contenu;
    }

    public function getAuteur(): User {
        return $this->auteur;
    }

    public function getPost(): Post {
        return $this->post;
    }

    public function getParentCommentaire(): ?Commentaire {
        return $this->parentCommentaire;
    }

    // Setters
    public function setContenu(string $contenu): void {
        $this->contenu = $contenu;
    }

    public function setAuteur(User $auteur): void {
        $this->auteur = $auteur;
    }

    public function setPost(Post $post): void {
        $this->post = $post;
    }

    public function setParentCommentaire(?Commentaire $parentCommentaire): void {
        $this->parentCommentaire = $parentCommentaire;
    }
}
?>