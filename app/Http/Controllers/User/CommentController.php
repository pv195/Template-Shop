<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $newDetails = $request->only(['user_id', 'product_id', 'content', 'parent_id']);
        if ($this->commentRepository->createComment($newDetails)) {
            return redirect()->back()->with('success', __('messages.create.success'));
        }

        return redirect()->back()->with('error', __('messages.create.fail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = $this->commentRepository->getCommentById($id);
        if (Gate::allows('edit-delete-comment', $comment)) {
            $comment = $request->only(['content']);
            $this->commentRepository->updateComment($comment, $id);

            return back()->with('success', __('messages.update.success'));
        }

        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->commentRepository->getCommentById($id);
        if (Gate::allows('edit-delete-comment', $comment)) {
            if ($comment->parent_id == 0) {
                $idReplyComments = [];
                $replyComments = $this->commentRepository->getReplyCommentByParentId($id);
                foreach ($replyComments as $item) {
                    $idReplyComments[] = $item->id;
                }
                $this->commentRepository->deleteComment($idReplyComments);
            }
            $this->commentRepository->deleteComment($id);

            return redirect()->back()->with('success', __('messages.delete.success'));
        }

        return abort(404);
    }
}
