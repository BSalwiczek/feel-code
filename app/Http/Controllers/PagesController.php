<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Quote;
use Mail;
use Session;

class PagesController extends Controller
{
    public function getHome()
    {
        $posts = Post::orderBy('id','desc')->where('status','=','1')->paginate(5);
        $quote = Quote::orderByRaw("RAND()")->first();
    	return view('home')->withPosts($posts)->withQuote($quote);
    }
    public function getAbout()
    {
    	return view('pages.about');
    }
    public function postAbout(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'message'=>'min:10',
            'name'=>'min:2',
            'subject'=>'min:2']);

        $data=[
        'mail'=>$request->email,
        'msg'=>$request->message,
        'name'=>$request->name,
        'subject'=>$request->subject];

        Mail::send('emails.contact',$data,function($message) use ($data){
            $message->from($data['mail']);
            $message->to('bartoszsalwiczek@gmail.com');
            $message->subject($data['subject']);
        });

        Session::flash('success','Message was successfully send !');
        return redirect()->route('about');
    }
    public function getSingle($slug)
    {
        $post = Post::where('slug','=',$slug)->first();
    	return view('pages.single')->withPost($post);
    }
    public function getCategories()
    {
        $categories = Category::all();
        return view('pages.categories')->withCategories($categories);
    }
}
