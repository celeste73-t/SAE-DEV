<?php
namespace model;

require_once __DIR__ . '/../service/Enum.php';

use service\UserRole;

class User {
    private ?int $id;
    private string $email;
    private string $nom;
    private string $password;
    private UserRole $role;

    public function __construct(?int $id, string $email, string $nom, string $password, UserRole $role) {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): UserRole {
        return $this->role;
    }

    // Setters
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPseudo(string $nom): void {
        $this->nom = $nom;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRole(UserRole $role): void {
        $this->role = $role;
    }

    public static function fromDatabaseArray(array $data): self {
        $role = match($data['userType']) {
            'votant' => UserRole::User,
            'candidat' => UserRole::Candidat,
            'administrateur' => UserRole::Admin,
            default => UserRole::Visiteur
        };

        return new self(
            (int)$data['id'],
            $data['email'],
            $data['nom'],
            $data['motDePasse'],
            $role
        );
    }
}
