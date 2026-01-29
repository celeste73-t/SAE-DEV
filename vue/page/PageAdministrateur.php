<?php
namespace vue\page;

class PageAdministrateur extends Page {
    private array $editions;

    public function __construct(string $title, array $editions) {
        $this->editions = $editions;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Espace Administrateur</h2>

            <!-- donnée JS -->
            <div id="editionData" 
                data-editions='<?= json_encode(array_map(function($e) { 
                    return [ 
                        "id" => $e->getId(), 
                        "nom" => $e->getNom(), 
                        "debutNomination" => $e->getDebutNomination()->format("Y-m-d"), 
                        "debutVote" => $e->getDebutVote()->format("Y-m-d"), 
                        "debutResultat" => $e->getDebutResultat()->format("Y-m-d") 
                    ]; 
                }, $this->editions)); ?>'> 
            </div>

            <form method="post" action="index.php?page=admin&action=validate"> 
                <label>Édition active :</label>
                <select name="activeEdition">
                    <?php
                        foreach ($this->editions as $edition) {
                            echo "<option value=" . $edition->getId() .">" .
                                $edition->getNom() .
                            "</option>";
                        }
                    ?>
                    <option value="new">Nouvelle édition</option>
                </select>

                <!-- Champ caché : vide = ajout, rempli = modification --> 
                <input type="hidden" name="editionId" id="editionId"> 
                
                <label>Nom :</label> 
                <input type="text" name="nom" id="nom"> 
                
                <label>Date Proposition :</label> 
                <input type="date" name="dateProposition" id="dateProposition"> 
                
                <label>Date Vote :</label> 
                <input type="date" name="dateVote" id="dateVote"> 
                
                <label>Date Résultat :</label> 
                <input type="date" name="dateResultat" id="dateResultat"> <button type="submit" id="submitBtn">Ajouter l’édition</button> 
            </form>
        </section>
        <?php
    }
}