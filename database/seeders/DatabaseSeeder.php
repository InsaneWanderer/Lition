<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new SubscriptionSeeder)->run();
        (new BookSeeder)->run();
        (new AuthorSeeder)->run();
        (new BookAuthorSeeder)->run();
        (new GenreSeeder)->run();
        (new BookGenreSeeder)->run();
        (new FilesSeeder)->run();
    }
}
