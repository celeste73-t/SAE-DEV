<?php
namespace model;

class Artist {
    private string $nom;
    private string $image;

    public function __construct(string $nom, string $image) {
        $this->nom = $nom;
        $this->image = $image;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getImage(): string {
        return $this->image;
    }
}