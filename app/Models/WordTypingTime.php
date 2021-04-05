<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordTypingTime extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function Test()
  {
    return $this->belongsTo(Test::class);
  }
}
