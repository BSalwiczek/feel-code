<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        $categories = [];
        foreach($cats as $cat)
        {
            $categories[$cat->id] = $cat->name;
        }
        
        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title'=>'required|max:255',
            'body'=>'required',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|integer',
            'home_body'=>'required'
            ));
        $post = new Post;
        $post->title = $request->title;
        // $post->body =str_replace(PHP_EOL,"&lt;br&frasl;&gt;",$request->body);
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->home_body = $request->home_body;
        $post->tags = $request->tags;
        $post->status = 0;
        $post->save();
        Session::flash('success','The blog post was successfully saved !');

        $posts = Post::all();
        return redirect()->route('posts.index')->withPosts($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $post->body = str_replace("&lt;br&frasl;&gt;","<br>",$post->body);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats = Category::all();
        $categories = [];
        foreach($cats as $cat)
        {
            $categories[$cat->id] = $cat->name;
        }

        $post = Post::find($id);
        return view('posts.edit')->withPost($post)->withCategories($categories);
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
        $post = Post::find($id);
        if ($request->input('slug') == $post->slug) {
            $this->validate($request,array(
            'title'=>'required|max:255',
            'body'=>'required',
            'category_id'=>'required|integer',
            'home_body'=>'required'
            ));
        }else{
            $this->validate($request,array(
            'title'=>'required|max:255',
            'body'=>'required',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|integer',
            'home_body'=>'required'
            ));
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->home_body = $request->home_body;
        $post->tags = $request->tags;
        $post->save();

        Session::flash('success','The blog post was successfully saved !');

        $posts = Post::all();
        return redirect()->route('posts.index')->withPosts($posts);

    }

    public function publish($id)
    {
        $post = Post::find($id);
        $post->status = 1;
        $post->save();

        $posts = Post::all();
        return redirect()->route('posts.index')->withPosts($posts);
    }

    public function hide($id)
    {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();

        $posts = Post::all();
        return redirect()->route('posts.index')->withPosts($posts);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success','The post was successfully deleted!');
        return redirect()->route('posts.index');
    }
}
