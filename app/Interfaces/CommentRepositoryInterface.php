<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAllComments();
    public function getParentCommentByIdProduct($productId);
    public function getReplyCommentByIdProduct($productId);
    public function getReplyCommentByParentId($productId);
    public function createComment(array $attributes);
    public function getCommentById($commentId);
    public function updateComment(array $attributes, $id);
    public function deleteComment($commentId);
}
