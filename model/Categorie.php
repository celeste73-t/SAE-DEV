<?php
namespace model;

class Categorie {
    private int $id;
    private string $nom;
    private ?string $description;
    private ?string $image;

    public function __construct(int $id, string $nom, ?string $description = null, ?string $image = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public static function fromDatabaseArray(array $data): Categorie { 
        return new Categorie( 
            $data['id'], 
            $data['nom'], 
            $data['description'] ?? null, 
            $data['image'] ?? null 
        ); 
    }
}
