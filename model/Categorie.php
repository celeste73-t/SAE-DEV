<?php
namespace model;

require_once __DIR__ . '/../service/Enum.php';

use service\CategorieType;

class Categorie {
    private int $id;
    private string $nom;
    private ?string $description;
    private ?string $image;
    private CategorieType $type;

    public function __construct(int $id, string $nom, ?string $description = null, ?string $image = null, CategorieType $type = CategorieType::Track) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->type = $type;
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

    public function getType(): CategorieType {
        return $this->type;
    }

    public static function fromDatabaseArray(array $data): Categorie { 
        return new Categorie( 
            $data['id'], 
            $data['nom'], 
            $data['description'] ?? null, 
            $data['image'] ?? null,
            CategorieType::from($data['type'])
        ); 
    }
}
