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
  public function getRandomUserWords($test_length = 20)
  {
    $words = [];
    while (count($words) < $test_length) {
      $query = $this->words()
        ->select('word')
        ->inRandomOrder()
        ->limit($test_length - count($words))
        ->get()
        ->toArray();
      array_push($words, ...$query);
    }
    return $words;
  }

  public function getAutoDifficultyWords($test_length = 20)
  {
    $words = [];
    while (count($words) < $test_length) {
      $query = $this->words()
        ->selectRaw('words.word, avg_wpm, -LOG(1.0 - RAND()) / avg_wpm as weight')
        ->leftJoinSub($this->wordsStatistics(), 'words_statistics', function ($join) {
          $join->on('words.word', '=', 'words_statistics.word');
        })
        ->orderBy('weight')
        ->limit($test_length - count($words))
        ->get()
        ->toArray();
      array_push($words, ...$query);
    }
    return $words;
    // return vsprintf(str_replace(['?'], ['\'%s\''], $query->toSql()), $query->getBindings());
  }

  public function wordsStatistics()
  {
    return $this->hasManyThrough(WordTypingTime::class, Test::class)
      ->selectRaw(
        '`tests`.`profile_id`, `word`, 60 / AVG(avg_time_per_key) / 5 as avg_wpm, COUNT(*) as samples, SUM(errors) as errors, (sum(length(word)) - sum(errors)) / sum(length(word)) * 100 as accuracy'
      )
      ->groupByRaw('`profile_id`, CAST(`word` as BINARY)');
  }

  public function charsStatistics()
  {
    return $this->hasManyThrough(CharStatistics::class, Test::class)
      ->selectRaw(
        '`tests`.`profile_id`, `char`, 60 / AVG(char_statistics.time) / 5 as avg_wpm, COUNT(*) as samples, SUM(correct) as correct, SUM(correct) / COUNT(*) * 100 as accuracy'
      )
      ->groupByRaw('`profile_id`, CAST(`char` as BINARY)');
  }
}
