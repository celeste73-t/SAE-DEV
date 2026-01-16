<?php
namespace interfaces\post;

interface IPostReader {
    public function getPostByPropositionId(int $propositionId): array;
}