<?php

namespace App\Http\Controllers;

use App\Models\CharStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Test;
use App\Models\User;
use App\Models\Profile;
use App\Models\RandomWord;
use App\Models\WordTypingTime;

class TestController extends Controller
{
  public function getNewTest(Request $request)
  {
    // $response = Http::get(
    //   'http://api.wordnik.com/v4/words.json/randomWords?hasDictionaryDef=true&minCorpusCount=0&minLength=3&maxLength=5&limit=10&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5'
    // )->json();
    // $text = '';
    // foreach ($response as $item) {
    //   if ($item === end($response)) {
    //     $text .= $item['word'];
    //   } else {
    //     $text .= $item['word'] . ' ';
    //   }
    // }
    // return $text;
    // return 'Stoi na stacji lokomotywa, ciężka ogromna i pot z niej spływa, tłusta oliwa.';
    if ($request->user === null) {
      return $this->getRandomWordsTest();
    }
    $user = User::findOrFail($request->user['id']);
    $profile = $user->selectedProfile()->first();
    if ($profile->use_words_from_api) {
      return $this->getRandomWordsTest($profile->test_length);
    }
    if ($profile->auto_difficulty) {
      $autoDifficultyWords = $profile->getAutoDifficultyWords($profile->test_length);
      return $this->convertToText($autoDifficultyWords);
    }
    $randomUserWords = $profile->getRandomUserWords($profile->test_length);
    return $this->convertToText($randomUserWords);
  }
  public function getRandomWordsTest($test_length = 20)
  {
    $RANDOM_WORDS = 100;
    $random_words_ids = [];
    for ($i = 0; $i < $test_length; $i++) {
      array_push($random_words_ids, rand(1, $RANDOM_WORDS));
    }
    $words = RandomWord::select('word')
      ->whereIn('id', $random_words_ids)
      ->get();
    return $this->convertToText($words);
  }

  public function convertToText($words)
  {
    $text = '';
    foreach ($words as $word) {
      $text .= $word['word'] . ' ';
    }
    return substr($text, 0, -1);
  }

  public function saveTestResults(Request $request)
  {
    $user = $request->user();
    $test = Test::create([
      'time' => $request->time,
      'test_length' => $request->testLength,
      'wpm' => $request->wpm,
      'uncorrected_errors' => $request->uncorrectedErrors,
      'all_errors' => $request->allErrors,
      'accuracy' => $request->accuracy,
      'score' => $request->score,
      'profile_id' => $user->selected_profile_id,
    ]);
    foreach ($request->wordsTypingTimes as $word) {
      $wordTypingTime = new WordTypingTime([
        'word' => $word['word'],
        'avg_time_per_key' => $word['avgTimePerKey'],
        'errors' => $word['errors'],
      ]);
      $test->wordsTypingTimes()->save($wordTypingTime);
    }
    foreach ($request->charsStatistics as $char) {
      if ($char['char'] === null) {
        continue;
      }
      $charStatistics = new CharStatistics([
        'char' => $char['char'],
        'time' => $char['time'],
        'correct' => $char['correct'],
      ]);
      $test->charsTypingTimes()->save($charStatistics);
    }
    return response()->json($test);
  }

  public function deleteTestResults(Request $request)
  {
    Test::findOrFail($request->id)->delete();
  }

  public function getProfileResults(Request $request)
  {
    $profile = Profile::findOrFail($request->profile_id);
    $tests = $profile->tests()->get();
    return response()->json($tests);
  }
}
