<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_genres')->insert([
            'book_id' => 1,
            'genre_id' => 1,
        ]);

        DB::table('book_genres')->insert([
            'book_id' => 1,
            'genre_id' => 2,
        ]);

        DB::table('book_genres')->insert([
            'book_id' => 1,
            'genre_id' => 3,
        ]);

        DB::table('book_genres')->insert([
            'book_id' => 1,
            'genre_id' => 4,
        ]);
    }
}
