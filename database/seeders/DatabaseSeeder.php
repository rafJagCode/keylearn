<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $words = Http::get('http://random-word-api.herokuapp.com/all?swear=1')->json();
    // \App\Models\User::factory(10)->create();

    $words = Http::get('http://random-word-api.herokuapp.com/word?number=100')->json();
    foreach ($words as $word) {
      DB::table('random_words')->insert(['word' => $word]);
    }
  }
}
