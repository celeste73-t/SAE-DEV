<?php
namespace model;

require_once __DIR__ . '/../service/Enum.php';

class User {
    private int $id;
    private string $email;
    private string $pseudo;
    private string $password;
    private UserRole $role;

    public function __construct(int $id, string $email, string $pseudo, string $password, UserRole $role) {
        $this->id = $id;
        $this->email = $email;
        $this->pseudo = $pseudo;
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

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): int {
        return $this->role;
    }

    // Setters
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRole(int $role): void {
        $this->role = $role;
    }
}
?>