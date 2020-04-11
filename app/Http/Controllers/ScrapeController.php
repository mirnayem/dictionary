<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

class ScrapeController extends Controller
{
    public function scrape(Request $request)
    {
       $url = $request->get('url');

       $client = new Client();
       $response = $client->request('GET', $url);

    $response_status_code = $response->getStatusCode(); 
    
    $html = $response->getBody()->getContents();  
    
    if($response_status_code == 200)
    {
        $dom = HtmlDomParser::str_get_html($html);

        $word_categories = $dom->find('div.view-content div.views-row');

        // foreach($word_categories as $word_cat){
        //     $cat_img = $word_cat->find("span.field-content div.views-field div.field-content a");
        //     dd($cat_img);
        // }

        dd($word_categories);
    }

}
}
