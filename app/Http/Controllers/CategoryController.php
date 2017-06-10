<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
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
        $categories = Category::all();

        return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name'=>'required|max:255'
            ));
        $category = new Category;
        $category->name = $request->name;

        $category->homePostImg = $request->homePostImg;
        $category->bgPostImg = $request->bgPostImg;
        $category->catImg = $request->catImg;

        $category->save();

        Session::flash('success','The category was successfully saved !');

        $categories = Category::all();
        return redirect()->route('categories-manager.index')->withCategories($categories);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit')->withCategory($category);
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
        $this->validate($request,array(
            'name'=>'required|max:255'
            ));
        $category = Category::find($id);

        $category->name = $request->name;
        $category->homePostImg = $request->homePostImg;
        $category->bgPostImg = $request->bgPostImg;
        $category->catImg = $request->catImg;
        $category->save();
        Session::flash('success','The category was successfully updated !');

        $categories = Category::all();
        return redirect()->route('categories-manager.index')->withCategories($categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect()->route('categories-manager.index');
    }
}
