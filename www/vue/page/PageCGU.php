<?php
namespace vue\page;

require_once 'vue/page/Page.php';

class PageCGU extends Page {
    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Conditions Générales d'Utilisation (CGU)</h2>
            <h4>Article 1 : Protection des données à caractère personnel</h4>
            <p>
                "Les données collectées (email, identifiant) sont strictement nécessaires à la gestion du processus électoral musical. Elles permettent de garantir qu'un utilisateur ne vote qu'une seule fois par catégorie. Conformément au RGPD et à la loi informatique et libertés, vous disposez d'un droit d'accès, de rectification, ect... . Vos données sont conservées jusqu'à la publication finale des résultats détaillés et sont protégées par des mesures de sécurité renforcées pour éviter tout vote multiple."
            </p>
            <h4>Article 2 : Propriété intellectuelle</h4>
            <p>
                "L'architecture technique, les algorithmes de validation des nominés, logo, base de donnée et l'interface de l'application sont la propriété exclusive de l'éditeur. Toute reproduction totale ou partielle est interdite et serait susceptible d’acte de contrefaçon. Les informations relatives aux artistes (noms, visuels) sont issues d'API tierces et restent la propriété de leurs ayants droit respectifs. L'utilisateur s'interdiction d'extraire de manière automatisée les données de résultats figées après clôture."
            </p>
        </section>
        <?php
    }
}
