<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralStatisticsController extends Controller
{
  public function getGeneralStatistics(Request $request)
  {
    $user = $request->user();
    return 'test';
  }
}
