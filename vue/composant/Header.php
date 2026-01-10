<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../service/SessionManager.php';
require_once __DIR__ . '/../../service/Enum.php';

use service\SessionManager;
use service\UserRole;

class Header extends Composant {
    protected function renderContent() {
        $session = SessionManager::getInstance();
        $isConnected = $session->isLogged();
        ?>
        <header>
            <a href="?page=accueil"><img src="vue/images/logo.png" alt="Logo"></a>
            <nav>
                <ul>
                    <?php if ($isConnected): ?>
                        <li><a href="?page=connexion&action=logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="?page=connexion">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="?page=contact">Contact</a></li>
                    <li><a href="?page=aPropos">À propos</a></li>
                </ul>
            </nav>
        </header>
        <?php
    }
}
