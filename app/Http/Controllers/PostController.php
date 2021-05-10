<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
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
        $data['posts'] = Post::paginate(5);
        return view("post.index", $data);
    }

        public function search(Request $request)
    {
        //$data = $request->all();
        $data = $request->input('search');
        $query = Post::select()
            ->join('categories as cat', 'posts.category_id', '=', 'cat.id')
            ->where('title', 'like', "%$data%")
            ->orWhere('author', 'like', "%$data%")
            ->orWhere('cat.name', 'like', "%$data%")
            ->get();
        return view("post.index")->with(["posts" => $query]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("post.create")->with(["categories" => $categories]);
    }

    /**
     *
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //$data = $request->all();

        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }
        Post::insert($data);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::findOrFail($id);
        $categories = Category::all();
        return view("post.edit")->with(["post" => $data, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        if ($request->hasFile('image')) {
            $post = Post::findOrFail($id);
            Storage::delete("public/$post->image");
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }
        Post::where('id','=', $id)->update($data);
        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route("post.index");
    }
}
