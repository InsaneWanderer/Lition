<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            0 => 'Роман',
            1 => 'Научная фантастика',
            2 => 'Фэнтези',
            3 => 'Приключения',
            4 => 'Комедия',
            5 => 'Детектив',
            6 => 'Поэзия',
            7 => 'Триллер',
        );

        foreach($array as $el)
        {
            DB::table('genres')->insert([
                'name' => "$el",
            ]);
        }
    }
}
