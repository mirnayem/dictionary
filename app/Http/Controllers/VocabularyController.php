<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class VocabularyController extends Controller
{
    public function words()
    {
        $root_page = HtmlDomParser::file_get_html('https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate', false, null, 0);
        
        $category_array = array();
        foreach($root_page->find('div.views-field.views-field-title') as $categories)
        {
            $catUrl = $categories->children(0)->children(0)->href;
            
            $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl", false, null, 0);
            
            $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
            
            $allxml =  $find_xmls->children(0)->children(0)->href;
            
            $words_xml = HtmlDomParser::file_get_html($allxml, false, null, 0);
            
            $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
            
            
           
            $words = array();
            
            foreach ($words_xml->find('SimpleQuestionItem') as $answer){
            
                $word = array();
                $word["image"]="https:".$answer->children(1)->children(1)->innertext;
                $word["sound"]= $answer->children(0)->children(1)->innertext;
                
                $words[$answer->children(3)->innertext] = $word;
            }

            $category_array[$category_name] = $words;
         
      
        }


        return view('words',  compact('category_array'));
    }
    
    
    
    
    public function categories()
    {
        $categories = HtmlDomParser::file_get_html('https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate', false, null, 0);
        
        return view('categories',compact('categories'));
        
    }


    public function words_by_category($cat)

    {
        $root_page = HtmlDomParser::file_get_html('https://learnenglish.britishcouncil.org/vocabulary/beginner-to-pre-intermediate', false, null, 0);
        
        $category_array = [];
        foreach($root_page->find('div.views-field.views-field-title') as $categories)
        {
            $catUrl = $categories->children(0)->children(0)->href;
            if($catUrl == "/vocabulary/beginner-to-pre-intermediate/$cat")
            {
            $category = HtmlDomParser::file_get_html("https://learnenglish.britishcouncil.org/$catUrl",false,null,0);
            
            $find_xmls = $category->find("div.field.field-name-body.field-type-text-with-summary.field-label-hidden div.field-items div.field-item.even",0);
            
            $allxml =  $find_xmls->children(0)->children(0)->href;
            
            $words_xml = HtmlDomParser::file_get_html($allxml, false, null, 0);
            
            $category_name = $category->find('h1#page-title.page__title.title',0)->innertext;     
            $category_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));

            
        //    if($category_name == $cat){
            $words = [];
            
            foreach ($words_xml->find('SimpleQuestionItem') as $answer){
            
                $word = array();
                $word["image"]="https:".$answer->children(1)->children(1)->innertext;
                $word["sound"]= $answer->children(0)->children(1)->innertext;
                
                $words[$answer->children(3)->innertext] = $word;
            }

            $category_array[$category_name] = $words;
         
        }
      
        }


         return view('words_by_category' ,compact('category_array'));

       
    }
}
