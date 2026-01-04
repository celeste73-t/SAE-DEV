<?php
namespace vue\page;

require_once __DIR__ . '/Page.php';

class PageConnexion extends Page {
    private $errorMessage;
    private $successMessage;

    public function __construct($title = "Connexion", $errorMessage = null, $successMessage = null) {
        $this->errorMessage = $errorMessage;
        $this->successMessage = $successMessage;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content">
            <h2>Connexion</h2>
            <?php if ($this->errorMessage): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($this->errorMessage); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->successMessage): ?>
                <div class="success-message">
                    <?php echo htmlspecialchars($this->successMessage); ?>
                </div>
            <?php endif; ?>
            <form action="index.php?page=connexion&action=login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
                <button type="submit" class="btn-submit">Se connecter</button>
                </form>
            </form>
            <a href="index.php?page=inscription">S'inscrire</a>
        </section>
        <?php
    }
}
