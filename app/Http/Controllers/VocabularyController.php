<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;
use App\Word;
use App\Category;

class VocabularyController extends Controller
{

   
    public function words()
    {
        $root_page = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate");
        
        $category_array = array();
        foreach($root_page->find('div.views-field.views-field-title') as $categories)
        {
            $catUrl = $categories->children(0)->children(0)->href;
            
            $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl");
            
            $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
            
            $allxml =  $find_xmls->children(0)->children(0)->href;
            
            $words_xml = HtmlDomParser::file_get_html($allxml);
            
            $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
            
            
           
            $words = array();
            
            foreach ($words_xml->find('SimpleQuestionItem') as $answer)
            {
            
                $word = array();
                $word["image"]="https:".$answer->children(1)->children(1)->innertext;
                $word["sound"]= $answer->children(0)->children(1)->innertext;
                
                $words[$answer->children(3)->innertext] = $word;
            }

            $category_array[$category_name] = $words;
          
      
        }


        return view('scraping.words',  compact('category_array'));
    }


    
    
    
    
    public function categories()
    {
        $url = "https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate";
        $categories = HtmlDomParser::file_get_html($url);
        
        return view('scraping.categories',compact('categories'));
        
    }



    public function storecategory()
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


    public function words_by_category($cat)

    {
        $root_page = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate");
        
        $category_array = [];
        foreach($root_page->find('div.views-field.views-field-title') as $categories)
        {
            $catUrl = $categories->children(0)->children(0)->href;
            if($catUrl == "/vocabulary/beginner-to-pre-intermediate/$cat")
            {
            $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl");
            
            $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
            
            $allxml =  $find_xmls->children(0)->children(0)->href;
            
            $words_xml = HtmlDomParser::file_get_html($allxml);
            
            $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
            $category_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));

            
        
            $words = [];
            
            foreach ($words_xml->find('SimpleQuestionItem') as $answer)
            {
            
                $word = array();
                $word["image"]="https:".$answer->children(1)->children(1)->innertext;
                $word["sound"]= $answer->children(0)->children(1)->innertext;
                
                $words[$answer->children(3)->innertext] = $word;
            }

            $category_array[$category_name] = $words;
         
        }
      
    }


         return view('scraping.words_by_category' ,compact('category_array'));

       
    }


   public function storeword()
   {
    $root_page = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate");
        
    $category_array = [];
    foreach($root_page->find('div.views-field.views-field-title') as $categories)
    {
        $catUrl = $categories->children(0)->children(0)->href;
        
        $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl");
        
        $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
        
        $allxml =  $find_xmls->children(0)->children(0)->href;
        
        $words_xml = HtmlDomParser::file_get_html($allxml);
        
        $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
        
        
       
        $vocabs = array();
        
        foreach ($words_xml->find('SimpleQuestionItem') as $answer)
        {
        
            $vocab = array();
            $vocab["image"]="https:".$answer->children(1)->children(1)->innertext;
          
            $vocab["sound"]= $answer->children(0)->children(1)->innertext;
            
            $vocabs[$answer->children(3)->innertext] = $vocab;
        }

        $category_array[$category_name] = $vocabs;
     
  
    }


    // store words 
    
    foreach($category_array as $category_name =>$vocabs)
    {
        
       foreach($vocabs as $vocab_name => $vocab)
       {
           $word = new Word();
           $word->category_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));
           $word->name = $vocab_name;
           $word->image = $vocab['image'];
           $word->audio = $vocab['sound'];

           $word->save();
    
       }

    }
    
   }
   
}
