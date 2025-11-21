<?php
// Assurez-vous que l'autoloader ou les 'require' nécessaires sont présents
require_once '../../service/ConnectionBDD.php';
require_once '../../dao/ConstanteDAO.php';

use dao\ConstanteDAO;

// --- Démarrage du test ---

// 1. Instancier le DAO (ce qui déclenche la connexion dans le constructeur)
try {
    $constanteDAO = new ConstanteDAO();
    $dates = $constanteDAO->getConstanteDate();
    if ($dates === false || empty($dates)) {
        echo "Connexion OK, mais la table 'constante_date' est vide ou il y a une erreur SQL lors de la SELECT.";
    } else {
        echo "Première ligne de constante_date : <br>";
        echo "<pre>";
        print_r($dates[0]);
        echo "</pre>";
    }

} catch (\Exception $e) {
    // Cela attrape les erreurs PDO non gérées ou autres exceptions
    echo "**ERREUR FATALE : La connexion ou la requête a échoué.** Détails : " . $e->getMessage();
}

?>