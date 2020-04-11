<?php

namespace App\Http\Controllers;

use Google\Cloud\Translate\TranslateClient;

use Sunra\PhpSimple\HtmlDomParser;

class ApiController extends Controller
{
    public function translate()
    {
    $apiKey = 'AIzaSyDcQonxROiIzmk0JQ8n1MVzT5m0VwWZt0o';
    $translate = new TranslateClient([
        'key' => $apiKey
    ]);
    
    // Translate text from english to french.
    $result = $translate->translate("করোনায় ইতালীয় ৩ মালিকের মৃত্যু", [
        'target' => 'en'
    ]);
    
     return $result['text'] ;

    
    }


    public function detect()
    {
        $apiKey = 'AIzaSyDcQonxROiIzmk0JQ8n1MVzT5m0VwWZt0o';
        $translate = new TranslateClient([
            'key' => $apiKey
        ]);
          
          // Detect the language of a string.
     $result = $translate->detectLanguage('میں ترجمہ ایپ کا استعمال کروں گا');

     return $result['languageCode'] . "\n";
    }

    public function languages()
    {
            $apiKey = 'AIzaSyDcQonxROiIzmk0JQ8n1MVzT5m0VwWZt0o';
        $translate = new TranslateClient([
            'key' => $apiKey
        ]);
        foreach ($translate->languages() as $code) {
            print("$code\n");
        }
    }

    public function target()
    {

        $apiKey = 'AIzaSyDcQonxROiIzmk0JQ8n1MVzT5m0VwWZt0o';
        $translate = new TranslateClient([
            'key' => $apiKey
        ]);
        global $argv;

        $targetLanguage = isset($argv[1]) ? $argv[1] : 'bn';
        $result = $translate->localizedLanguages([
            'target' => $targetLanguage,
        ]);
        foreach ($result as $lang) {
            printf('%s: %s' . PHP_EOL, $lang['code'], $lang['name']);
        }
    }

  

 


   
}
