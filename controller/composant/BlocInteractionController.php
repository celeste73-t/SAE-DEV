<?php
namespace controller\composant;

require_once 'vue/composant/BlocInteraction.php';
require_once 'interfaces/post/IPostReader.php';
require_once 'interfaces/post/IPostWriter.php';
require_once 'interfaces/commentaire/ICommentaireReader.php';
require_once 'interfaces/commentaire/ICommentaireWriter.php';

use vue\composant\BlocInteraction;
use interfaces\post\IPostReader;
use interfaces\post\IPostWriter;
use interfaces\commentaire\ICommentaireReader;
use interfaces\commentaire\ICommentaireWriter;

class BlocInteractionController {
    private IPostReader $postReader;
    private IPostWriter $postWriter;
    private ICommentaireReader $commentaireReader;
    private ICommentaireWriter $commentWriter;
    private int $propositionId;

    public function __construct(IPostReader $postReader, 
                                IPostWriter $postWriter, 
                                ICommentaireReader $commentaireReader, 
                                ICommentaireWriter $commentWriter, 
                                int $propositionId) {
        $this->postReader = $postReader;
        $this->postWriter = $postWriter;
        $this->commentaireReader = $commentaireReader;
        $this->commentWriter = $commentWriter;
        $this->propositionId = $propositionId;
    }

    public function build() {
        $postsData = $this->postReader->getPostByPropositionId($this->propositionId); 
        
        $postsViews = []; 
        foreach ($postsData as $row) { 
            $postController = new PostController($this->postWriter, $this->commentaireReader, $this->commentWriter);
            $postsViews[] =  $postController->build($row['post'], $row['auteur']);
        }
        return new BlocInteraction($this->propositionId, $postsViews);
    }
}
 