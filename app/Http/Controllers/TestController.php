<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function getNewTest()
    {
        $response = Http::get('http://api.wordnik.com/v4/words.json/randomWords?hasDictionaryDef=true&minCorpusCount=0&minLength=5&maxLength=15&limit=10&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5')->json();
        $text = '';
        foreach($response as $item){
            if($item === end($response)) $text .= $item['word'];
            else $text .= $item['word'] . ' ';
        }
        return $text;
    }
}
