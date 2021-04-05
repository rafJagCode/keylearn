<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Test extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function profile()
  {
    return $this->belongsTo(Profile::class);
  }
  public function wordsTypingTimes()
  {
    return $this->hasMany(WordTypingTime::class);
  }
  public function charsTypingTimes()
  {
    return $this->hasMany(CharStatistics::class);
  }

  public function wordsStatistics()
  {
  }

  public function charsStatistics()
  {
    return $this->hasMany(CharStatistics::class)
      ->selectRaw(
        'test_id, `char`, AVG(CASE WHEN correct = 1 THEN time ELSE NULL END) as avg_time, COUNT(id) as samples, SUM(correct) as correct'
      )
      ->groupByRaw('CAST(`char` as BINARY)')
      ->having('avg_time', '!=', 0);
  }
}
