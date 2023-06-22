<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $title = 'Creazione di un nuovo post';
        $method = 'POST';
        $route = 'admin.post.store';
        return view('admin.posts.create',compact('post','title','method','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        if(array_key_exists('image',$form_data)){
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            $form_data['image_path'] = Storage::put('storage', $form_data['image']);

        }

        $form_data['slug'] = Post::generateSlug($form_data['title']);
        $form_data['date'] = date('Y-m-d');

        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = "Modifica di :" . $post->title;
        $method = 'PUT';
        $route = 'admin.post.store';
        return view('admin.posts.create', compact('post','title','method','route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $title = 'Creazione di un nuovo post';
        $method = 'POST';
        $route = 'admin.post.store';
        dd($post);
        return view('admin.posts.create',compact('title','method','route'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image_path){
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted','Post eliminato correttamente');
    }
}
