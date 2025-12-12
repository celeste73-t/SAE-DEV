<?php
namespace model;

// Importation des dépendances
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Categorie.php';

class Chanson {
    private int $id;
    private ?string $titre;
    private User $candidat; // Utilisation de l'objet User pour le candidat
    private Categorie $categorie; // Utilisation de l'objet Categorie
    private ?int $compteurVote1;
    private ?string $compteurVote2; // C'est un VARCHAR dans la BDD, je le garde en string

    public function __construct(int $id, ?string $titre, User $candidat, Categorie $categorie, ?int $compteurVote1 = null, ?string $compteurVote2 = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->candidat = $candidat;
        $this->categorie = $categorie;
        $this->compteurVote1 = $compteurVote1;
        $this->compteurVote2 = $compteurVote2;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function getCandidat(): User {
        return $this->candidat;
    }

    public function getCategorie(): Categorie {
        return $this->categorie;
    }

    public function getCompteurVote1(): ?int {
        return $this->compteurVote1;
    }

    public function getCompteurVote2(): ?string {
        return $this->compteurVote2;
    }

    // Setters
    public function setTitre(?string $titre): void {
        $this->titre = $titre;
    }

    public function setCandidat(User $candidat): void {
        $this->candidat = $candidat;
    }

    public function setCategorie(Categorie $categorie): void {
        $this->categorie = $categorie;
    }

    public function setCompteurVote1(?int $compteurVote1): void {
        $this->compteurVote1 = $compteurVote1;
    }

    public function setCompteurVote2(?string $compteurVote2): void {
        $this->compteurVote2 = $compteurVote2;
    }
}
