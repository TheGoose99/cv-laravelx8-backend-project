<?php

namespace App\Http\Controllers;

use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function createReply(Request $request) {

        $user = Auth::user();

        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->id,
            'email' => $user->email,
            'body' => $request->body,
        ];

        CommentReply::create($data);

        session()->flash('reply-created-message', 'Your reply has been submmited and is waiting moderation');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function show(CommentReply $commentReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentReply $commentReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $commentReply, $id)
    {
        $ceva = CommentReply::findOrFail($id)->update($request->all());

        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentReply  $commentReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CommentReply $commentReply)
    {
        $id= CommentReply::find($request->comment_id);
        $id->delete();
        return back();
    }
}
