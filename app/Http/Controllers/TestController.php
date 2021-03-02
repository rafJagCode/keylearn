<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Test;
use App\Models\User;

class TestController extends Controller
{
    public function getNewTest()
    {
        $response = Http::get('http://api.wordnik.com/v4/words.json/randomWords?hasDictionaryDef=true&minCorpusCount=0&minLength=3&maxLength=5&limit=10&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5')->json();
        $text = '';
        foreach($response as $item){
            if($item === end($response)) $text .= $item['word'];
            else $text .= $item['word'] . ' ';
        }
        return $text;
    }

    public function saveTestResults(Request $request)
    {
        $test = Test::create([
            'time' => $request->time,
            'test_length' => $request->testLength,
            'wpm' => $request->wpm,
            'uncorrected_errors' => $request->uncorrectedErrors,
            'all_errors' => $request->allErrors,
            'accuracy' => $request->accuracy,
            'score' => $request->score,
            'user_id' => $request->user_id
        ]);
        return response()->json($test);
    }

    public function deleteTestResults(Request $request)
    {
        Test::findOrFail($request->id)->delete();
    }

    public function getUserResults(Request $request)
    {
        $user = User::findOrFail($request->id);
        $tests = $user->tests()->get();
        return response()->json($tests);
    }
}
