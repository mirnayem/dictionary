<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Word;

class AdminController extends Controller
{
    public function index()
    {
        $allCategory = Category::all();
        
        return  view('admin.index',compact('allCategory'));
    }

    public function categoryWord($category_name)
    {
        $words = Word::where('category_name', $category_name)->get();

        return view('admin.category.word',compact('words','category_name'));
    }


    public function allWords()
    {
        $allWords = Word::all();
        return view('admin.word.index',compact('allWords'));
    }


}
