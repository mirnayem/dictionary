<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Word;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

   
    public function create()
    {
        return view('categories.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request,[
              'name' => 'required | min:3 | max:50',
        ]);

        $category = new Category();

        $category->name = $request->name;

        $category->save();

        return redirect('/');
    }

  
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit',compact('category'));
    }

    public function show($id)
    {
        
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required | min:3 | max:50',
        ]);
        $category = Category::findOrFail($id);
        
        $category->name  = $request->name;

        $category->update();

        return redirect('/');
    }

    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect('/');
    }


    public function category_word($category_name)
    {
       
        $words = Word::where('category_name', $category_name)->get();

        return view('categories.words',compact('words','category_name'));
    }
}
