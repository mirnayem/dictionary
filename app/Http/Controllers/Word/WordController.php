<?php

namespace App\Http\Controllers\Word;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Word;
use App\Category;
use Illuminate\Support\Str;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allwords = Word::all();

        return view('words.index',compact('allwords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('words.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
           'name' => 'required ',
           'category_name' => 'required',
        ]);


        $word = new Word();

        $word->name = $request->name;
        $word->category_name = Str::slug($request->category_name);
        $word->image = $request->image;
        $word->audio = $request->audio;
        $word->save();
        return redirect('/');
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
        $word = Word::findOrFail($id);
        $categories = Category::all();
        return view('words.edit',compact('word','categories'));
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
        $word = Word::findOrFail($id);

        $word->name = $request->name;
        $word->category_name = Str::slug($request->category_name);
        $word->image = $request->image;
        $word->audio = $request->audio;
        $word->update();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->delete();
        return redirect('/');
    }
}
