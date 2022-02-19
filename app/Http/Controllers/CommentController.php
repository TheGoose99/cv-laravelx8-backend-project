<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\CommentReply;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.comments.index", [
            'comments'=>Comment::all(),
            'replies'=>CommentReply::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Comment::class);

        return view('admin.comments.create');
    }

    public function createComment() {
        $inputs = request()->validate([
            'post_id' => 'required',
            'author' => 'required',
            'email' => 'required',
            'body' => 'required',
        ]);

        Comment::create($inputs);

        session()->flash('comment-created-message', 'Comment of author '. $inputs['author']. ' was created!');

        return redirect()->route('comments.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Comment::class);

        $user = Auth::user();

        $data = [
            'post_id' => $request->post_id,
            'author' => $user->id,
            'email' => $user->email,
            'body' => $request->body,
        ];

        Comment::create($data);

        $request->session()->flash('comment-message', 'Your message has been submitted and is waiting moderation');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, $id)
    {
        $post = Post::findorFail($id);
        $comments = $post->comments;

        return view('admin.comments.show', [
            'comments'=>$comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', [
            'comment'=>$comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Comment::findOrFail($id)->update($request->all());

        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash('comment-deleted', 'Comment '. $comment->id. ' deleted');

        return back();
    }

    public function updateText(Comment $comment) {
        $inputs = request()->validate([
            'author' => 'required',
            'body' => 'required',
        ]);

        $comment->author = $inputs['author'];
        $comment->body = $inputs['body'];

        if ($comment->isDirty('body', 'author')) {
            session()->flash('comment-updated', 'Comment number '. $comment->id. ' was updated!');
            $comment->save();
        } else {
            session()->flash('comment-updated', 'Nothing to update...');
        }

        return redirect()->route('comments.index');
    }
}
