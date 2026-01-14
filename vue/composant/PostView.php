<?php
namespace vue\composant;

require_once __DIR__ . '/Composant.php';
require_once __DIR__ . '/../../model/Post.php';

use model\Post;

class PostView extends Composant {
    private Post $post;
    private string $auteur;
    
    public function __construct(Post $post, string $auteur) {
        $this->post = $post;
        $this->auteur = $auteur;
        parent::__construct("post");
    }

    protected function renderContent() {
        echo $this->auteur . "<br>";
        echo $this->post->getTitre() . "<br>";
        echo $this->post->getContenu();
    }
}
