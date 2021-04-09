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
}
