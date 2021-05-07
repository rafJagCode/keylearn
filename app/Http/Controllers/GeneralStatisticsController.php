<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralStatisticsController extends Controller
{
  public function getGeneralStatistics(Request $request)
  {
    $user = $request->user();
    $wordsCount = null;
    $charsCount = null;
    $averageAccuracy = null;
    $averageWpm = null;
    $user
      ->profiles()
      ->with([
        'tests' => function ($q) use (&$wordsCount, &$charsCount, &$averageAccuracy, &$averageWpm) {
          $averageAccuracy = $q->avg('accuracy');
          $averageWpm = $q->avg('wpm');
          $q->with([
            'wordsTypingTimes' => function ($q) use (&$wordsCount) {
              $wordsCount = $q->count();
            },
            'charsTypingTimes' => function ($q) use (&$charsCount) {
              $charsCount = $q->count();
            },
          ]);
        },
      ])
      ->get();
    $generalStatistics = [
      'wordsCount' => $wordsCount,
      'charsCount' => $charsCount,
      'averageAccuracy' => $averageAccuracy,
      'averageWpm' => $averageWpm,
    ];
    return response()->json($generalStatistics);
  }
}
