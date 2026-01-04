<?php
namespace controller;

require_once __DIR__ . '/../vue\page\PageContact.php';
use vue\page\PageContact;

class ContactController {
    public function index() {
        $page = new PageContact("Contact");
        $page->render(); // le contrôleur déclenche l’affichage
    }
}
 