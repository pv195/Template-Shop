<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * get all Comments
     *
     * @return void
     */
    public function getAllComments()
    {
        return Comment::all();
    }

    /**
     * Get Comment by product id with parent Id equals 0
     *
     * @param int
     */
    public function getParentCommentByIdProduct($productId)
    {
        return Comment::where('product_id', $productId)->where('parent_id', 0)->orderBy('id', 'desc')->paginate(3);
    }

    /**
     * Get Comment by product id with parent Id other than 0
     *
     * @param int
     */
    public function getReplyCommentByIdProduct($productId)
    {
        return Comment::where('product_id', $productId)->where('parent_id','!=', 0)->orderBy('id', 'desc')->get();
    }

    /**
     * Get Comment by parent id
     *
     * @param int
     */
    public function getReplyCommentByParentId($parentId)
    {
        return Comment::where('parent_id', $parentId)->get();
    }
    
    /**
     * create Comment 
     *
     * @param array
     * @return mixed
     */
    public function createComment(array $attributes)
    {
        return Comment::create($attributes);
    }

    /**
     * Get Comment by id 
     *
     * @param int
     */
    public function getCommentById($commentId)
    {
        return Comment::findOrFail($commentId);
    }

    /**
     * Update Comment 
     *
     * @return mixed
     */
    public function updateComment(array $attributes, $id)
    {
        return Comment::whereId($id)->update($attributes);
    }

    /**
     * delete Comment by id 
     *
     * @param int
     */
    public function deleteComment($commentId)
    {
        return Comment::destroy($commentId);
    }
}
