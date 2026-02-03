<?php
namespace model;

class PropositionItem {
    private ?int $id;
    private int $idDeezer;
    private string $titre;
    private string $artiste;
    private string $image;

    public function __construct(?int $id, int $idDeezer, string $titre, string $artiste, string $image) {
        $this->id = $id;
        $this->idDeezer = $idDeezer;
        $this->titre = $titre;
        $this->artiste = $artiste;
        $this->image = $image;
    }
    public function getId(): ?int {
        return $this->id;
    }
    
    public function getIdDeezer(): int {
        return $this->idDeezer;
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
