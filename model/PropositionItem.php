<?php
namespace model;

require_once __DIR__ . '/User.php';

class PropositionItem {
    private int $idDeezer;
    private string $type;
    private string $titre;
    private string $artiste;
    private string $image;

    public function __construct(int $idDeezer, string $type, string $titre, string $artiste, string $image) {
        $this->idDeezer = $idDeezer;
        $this->type = $type;
        $this->titre = $titre;
        $this->artiste = $artiste;
        $this->image = $image;
    }

    public function getIdDeezer(): int {
        return $this->idDeezer;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getArtiste(): string {
        return $this->artiste;
    }

    public function getImage(): string {
        return $this->image;
    }
}
