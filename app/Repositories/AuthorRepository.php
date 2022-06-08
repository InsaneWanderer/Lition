<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function getIds(array $data)
    {
        $authorsId = array();
        foreach ($data as $author) {
            $author = Author::firstOrCreate(
                ['name' => $author['name']],
                ['surname' => $author['surname']]
            );
            array_push($authorsId, $author->id);
        }
        return $authorsId();
    }
}
