<?php
namespace controller\composant;

require_once 'vue/composant/BlocInteraction.php';
require_once 'dao/PostDAO.php';

use vue\composant\BlocInteraction;
use dao\PostDAO;

class BlocInteractionController {
    private $propositionId;

    public function __construct($propositionId) {
        $this->propositionId = $propositionId;
    }

    public function build() {
        $postDAO = new PostDAO(); 
        $postsData = $postDAO->getPostByPropositionId($this->propositionId); 
        
        $postsViews = []; 
        foreach ($postsData as $row) { 
            $postController = new PostController();
            $postsViews[] =  $postController->build($row['post'], $row['auteur']);
        }
        return new BlocInteraction($this->propositionId, $postsViews);
    }
}
 