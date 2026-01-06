<?php
namespace model;

require_once __DIR__ . '/Artist.php';
require_once __DIR__ . '/Album.php';

use model\Artist;
use model\Album;

class Track {
    private string $titre;
    private Artist $artiste;
    private Album $album;

    public function __construct(string $titre, Artist $artiste, Album $album) {
        $this->titre = $titre;
        $this->artiste = $artiste;
        $this->album = $album;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getArtiste(): Artist {
        return $this->artiste;
    }

    public function getAlbum(): Album {
        return $this->album;
    }
}