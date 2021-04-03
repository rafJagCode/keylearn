<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	use HasFactory;
	protected $guarded = [];

	public function profile()
	{
		return $this->belongsTo(Profile::class);
	}
	public function WordsTypingTimes()
	{
		return $this->hasMany(WordTypingTime::class);
	}
	public function CharsStatistics()
	{
		return $this->hasMany(CharStatistics::class);
	}
}
