<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\SubComment;
use Session;

class SubCommentsController extends Controller
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
    public function store(Request $request,$comm_id)
    {
        $commID = intval($comm_id);
        if($commID > 0)
        {
            $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment'=>'required|min:5|max:2000'
            ]);

            $comment = Comment::find($commID);

            $sub_comment = new SubComment;
            $sub_comment->name = $request->name;
            Session::set('com_name',$request->name);
            $sub_comment->email = $request->email;
            Session::set('com_email',$request->email);
            $sub_comment->comment = $request->comment;
            $sub_comment->approved = true;
            $sub_comment->comment()->associate($comment);
            
            $sub_comment->save();

            return $commID;
        }else
        {
            return "nienei";
        }
    }

    public function postSubComments(Request $request)
    {
        $comm_id = $_POST['id'];
        $comments = DB::table('sub_comments')->where('comment_id','=',$comm_id)->orderBy('id','desc')->get()->toArray();
        return response()->json(['success'=>true,'comments'=>$comments]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
