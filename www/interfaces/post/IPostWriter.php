<?php
namespace interfaces\post;

require_once 'model/Post.php';

use model\Post;

interface IPostWriter {
    public function createPost(Post $post, int $propositionId): void;
}