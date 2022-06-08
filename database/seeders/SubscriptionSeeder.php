<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'name' => 'ЛАЙТ',
            'price' => 199,
            'description' => 'Книги на каждый день',
            'cover' => 'public/subscriptions/14043255.jpg',
        ]);

        DB::table('subscriptions')->insert([
            'name' => 'ОПТИМУМ',
            'price' => 399,
            'description' => '«Лайт» + новинки',
            'cover' => 'public/subscriptions/14043255.jpg',
        ]);

        DB::table('subscriptions')->insert([
            'name' => 'ПРЕМИУМ',
            'price' => 799,
            'description' => '«Оптимум» + книги на других языках',
            'cover' => 'public/subscriptions/14043255.jpg',
        ]);
    }
}
