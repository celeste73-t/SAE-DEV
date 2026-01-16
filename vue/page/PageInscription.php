<?php
namespace vue\page;

require_once 'vue/page/Page.php';

class PageInscription extends Page {
    private $errorMessage;
    private $successMessage;

    public function __construct($title = "Inscription", $errorMessage = null) {
        $this->errorMessage = $errorMessage;
        parent::__construct($title);
    }

    protected function renderContent() {
        ?>
        <section class="content connexion">
            <h2>Inscription</h2>
            <?php if ($this->errorMessage): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($this->errorMessage); ?>
                </div>
            <?php endif; ?>
            <form action="index.php?page=inscription&action=register" method="post">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
                <p>En vous inscrivant vous valider avoir lue et accepté les <a href="index.php?page=cgu">conditions générales d'utilisation</a></p>
                <button type="submit" class="btn-submit">S'inscrire</button>
            </form>
            <a href="index.php?page=connexion">Se connecter</a>
        </section>
        <?php
    }
}
