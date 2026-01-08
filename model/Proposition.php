<?php
namespace model;

require_once __DIR__ . '/User.php';

class Proposition {
    private int $id;
    private string $type;
    private string $titre;
    private string $artiste;
    private string $image;

    public function __construct(int $id, string $type, string $titre, string $artiste, string $image) {
        $this->id = $id;
        $this->type = $type;
        $this->titre = $titre;
        $this->artiste = $artiste;
        $this->image = $image;
    }

    public function getId(): int {
        return $this->id;
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
