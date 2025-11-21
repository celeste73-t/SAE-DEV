<?php
namespace model;

class Constante {
    private int $id
    private Date $startPremierTour
    private Date $endPremierTour
    private Date $startSecondTour
    private Date $endSecondTour

    public function __construct(
        int $id,
        Date $startPremierTour,
        Date $endPremierTour,
        Date $startSecondTour,
        Date $endSecondTour
    ) {
        $this->id = $id;
        $this->startPremierTour = $startPremierTour;
        $this->endPremierTour = $endPremierTour;
        $this->startSecondTour = $startSecondTour;
        $this->endSecondTour = $endSecondTour;
    }

    
    public function getId(): int {
        return $this->id = $id;
    }

    public function getStartPremierTour(): int {
        return $this->startPremierTour = $startPremierTour;
    }

    public function getEndPremierTour(): int {
        return $this->endPremierTour = $endPremierTour;
    }

    public function getStartSecondTour(): int {
        return $this->startSecondTour = $startSecondTour;
    }

    public function getEndSecondTour(): int {
        return $this->endSecondTour = $endSecondTour;
    }
    
}
?>