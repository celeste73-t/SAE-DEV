<?php
namespace vue\composant;

require_once 'vue/composant/Composant.php';

class Footer extends Composant {
    protected function renderContent() {
        ?>
        <footer>
            <h2>Mentions Légales</h2>
            <h4>Éditeur et Directeur de la publication</h4>
            <p> Rafaël HOFF:</p>
            <a href="mailto:hoff.rafael06@gmail.com">
                hoff.rafael06@gmail.com
            </a>
            <p> Celeste TOLEC:</p>
            <a href="mailto:celeste.tollec@gmail.com">
                celeste.tollec@gmail.com
            </a>
            <p> Noah CLEON</p>
            <h4>Hébergeur</h4>
            <p>OVHCloud <br> rue Kellermann- 59100 Roubaix- France</p>
            <a href="https://www.ovhcloud.com/fr">www.ovhcloud.com/fr</a>
        </footer>
        <?php
    }
}
