<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index() {
        $posts=Post::all();
        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function show (Post $post) {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function store(Request $request) {
        
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();
        
        $post = Post::create($validated);

        // $post = Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body
        // ]);
        $request->session()->flash('message', '保存しました');
        return back();
    }

    public function update(Request $request, Post $post) {
        
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();
        
        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return back();
    }

    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }
}
