<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

use App\Category;

class CategoryController extends Controller
{
   
    public function store()
    {
        $root_page = HtmlDomParser::file_get_html('https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate');
        
        $category_array = [];
        foreach($root_page->find('div.views-field.views-field-title') as $categories)
        {
            $catUrl = $categories->children(0)->children(0)->href;
            
            $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl");
         
            
            $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
            
            
            $all_cateogory = [];
          

            $category_array[$category_name] = $all_cateogory;

            
        }

        foreach($category_array as $category_name =>$all_cateogory){
          
            $category = new Category();

            $category->name = $category_name;

            $category->save();

        }
      

    }

   
}
