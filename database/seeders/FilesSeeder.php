<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();

        foreach($books as $book)
        {
            DB::table('files')->insert([
                'book_id' => $book->id,
                'file_type' => 'ru',
                'path' => 'public/books/дюна/Херберт Фрэнк. Дюна.txt',
            ]);
        }

    }
}
