<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function tests()
  {
    return $this->hasMany(Test::class);
  }
  public function words()
  {
    return $this->hasMany(Word::class);
  }
  public function wordsStatistics()
  {
    return $this->hasManyThrough(WordTypingTime::class, Test::class)
      ->selectRaw(
        '`word`, AVG(CASE WHEN errors = 0 THEN avg_time_per_key ELSE NULL END) as avg_time_per_key, COUNT(*) as samples, SUM(errors) as errors'
      )
      ->groupByRaw('CAST(`word` as BINARY)')
      ->having('avg_time_per_key', '!=', 0);
  }

  public function charsStatistics()
  {
    return $this->hasManyThrough(CharStatistics::class, Test::class)
      ->selectRaw(
        '`char`, AVG(CASE WHEN correct = 1 THEN char_statistics.time ELSE NULL END) as avg_time, COUNT(*) as samples, SUM(correct) as correct'
      )
      ->groupByRaw('CAST(`char` as BINARY)')
      ->having('avg_time', '!=', 0);
  }
}
