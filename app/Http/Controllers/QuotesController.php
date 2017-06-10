<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use Session;

class QuotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all();
        return view('quotes.index')->withQuotes($quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['author'=>'required|max:255','content'=>'required']);
        $quote = new Quote;
        $quote->author = $request->author;
        $quote->content = $request->content;
        $quote->save();

        $quotes = Quote::all();
        Session::flash('success','Thos quote was successfully saved!');
        return redirect()->route('quotes.index')->withQuotes($quotes);
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
        $quote = Quote::find($id);
        return view('quotes.edit')->withQuote($quote);
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
        $this->validate($request,['author'=>'required|max:255','content'=>'required']);
        $quote = Quote::find($id);
        $quote->author = $request->author;
        $quote->content = $request->content;
        $quote->save();

        $quotes = Quote::all();
        Session::flash('success','Thos quote was successfully saved!');
        return redirect()->route('quotes.index')->withQuotes($quotes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        $quote->delete();

        $quote = Quote::all();
        return redirect()->route('quotes.index')->withQuotes($quote);
    }
}
