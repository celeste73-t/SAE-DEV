<?php
namespace model;

require_once __DIR__ . '/Artist.php';

use model\Artist;

class Album {
    private string $titre;
    private Artist $artiste;
    private string $image;

    public function __construct(string $titre, Artist $artiste, string $image) {
        $this->titre = $titre;
        $this->artiste = $artiste;
        $this->image = $image;
    }

    public function getTitre(): string {
        return $this->titre;
    }
    
    public function getArtiste(): Artist {
        return $this->artiste;
    }

    public function getImage(): string {
        return $this->image;
    }
}