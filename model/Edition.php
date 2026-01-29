<?php
namespace model;

use DateTime;

class Edition {
    private ?int $id;
    private string $nom;
    private DateTime $debutNomination;
    private DateTime $debutVote;
    private DateTime $debutResultat;
    private bool $active;

    public function __construct(
        ?int $id,
        string $nom,
        DateTime $debutNomination,
        DateTime $debutVote,
        DateTime $debutResultat,
        bool $active
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->debutNomination = $debutNomination;
        $this->debutVote = $debutVote;
        $this->debutResultat = $debutResultat;
        $this->active = $active;
    }

    
    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getDebutNomination(): DateTime {
        return $this->debutNomination;
    }

    public function getDebutVote(): DateTime {
        return $this->debutVote;
    }

    public function getDebutResultat(): DateTime {
        return $this->debutResultat;
    }

    public function isActive(): bool {
        return $this->active;
    }
}
