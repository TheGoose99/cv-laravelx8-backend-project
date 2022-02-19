<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use App\Models\CommentReply;

class PostController extends Controller
{

    public function index() {

        // Asa 5) "MOST COMMONLY USED":
        $posts = auth()->user()->posts()->paginate(5);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    // Injection of class:
    public function show(Post $post) {

        $comments = $post->comments->where('is_active', '1');

        return view('blog-post', [
            'post'=> $post,
            'comments' => $comments,
        ]);
    }

    public function create(Post $post) {
        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    public function store() {

        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title' => 'required|min:5|max:255',
            'post_image' => 'mimes:jpeg,png,jfif|file',
            'body' => 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', 'Post with title '. $inputs['title']. ' was created!');

        return redirect()->route('post.index');
    }

    public function edit(Post $post) {
        // Asa 1):
        $this->authorize('view', $post);

        // Asa 2):
        // if(auth()->usser()->can('view', $post)) {

        // }

        // Asa 3) Middleware in route:
        // Asa 4) Cu Blaze @can('view', $post) @endcan:

        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function destroy(Post $post) {

        $this->authorize('delete', $post);

        $post->delete();

        // Sau putem accesa $request la fel:
        // $request->session()->flash('message', 'Post was deleted');

        Session::flash('message', 'Post was deleted');

        return back();
    }

    public function update(Post $post) {

        $inputs = request()->validate([
            'title' => 'required|min:5|max:255',
            'post_image' => 'mimes:jpeg,png,jfif|file',
            'body' => 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        //  Pt daca vrei sa faci cu postarile user-ului logat/ sa atribui acele postarile ca ale tale
        // auth()->user()->posts()->save($post);

        $this->authorize('update', $post);

        $post->update();

        session()->flash('post-updated-message', 'Post with title '. $inputs['title']. ' was updated!');

        return redirect()->route('post.index');
    }

}
