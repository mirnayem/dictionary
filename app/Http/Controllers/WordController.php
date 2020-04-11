<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class WordController extends Controller
{
   public function store()
   {

    $root_page = HtmlDomParser::file_get_html('https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate');
        
    $category_array = [];
    foreach($root_page->find('div.views-field.views-field-title') as $categories)
    {
        $catUrl = $categories->children(0)->children(0)->href;
        
        $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl");
        
        $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
        
        $allxml =  $find_xmls->children(0)->children(0)->href;
        
        $words_xml = HtmlDomParser::file_get_html($allxml);
        
        $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
        
        
        $words =[];
        
        foreach ($words_xml->find('SimpleQuestionItem') as $answer){
        
            $word = array();
            $word["image"]="https:".$answer->children(1)->children(1)->innertext;
            $word["sound"]= $answer->children(0)->children(1)->innertext;
            
            $words[$answer->children(3)->innertext] = $word;
        }

        $category_array[$category_name] = $words;
        
    }
    
    //store word list

    foreach ($category_array as $category_name => $words) 
    {
       $store_word = new Word();

       $store_word->category_name = $category_name;
       foreach($words as $word_name => $word)
       {
           $store_word->name = $word;
       }
    }
    
   

   }
}
