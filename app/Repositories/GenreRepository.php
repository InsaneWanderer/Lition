<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function getIds(array $data)
    {
        $genresId = array();
        foreach ($data as $genre) {
            $genreNew = Genre::firstOrCreate(
                ['name' => $genre]
            );
            array_push($genresId, $genreNew->id);
        }
        return $genresId;
    }
}
