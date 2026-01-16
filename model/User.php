<?php
namespace model;

require_once 'service/Enum.php';

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
}
