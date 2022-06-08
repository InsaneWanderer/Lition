<?php

namespace App\Repositories;

use App\Models\Collection;

class CollectionRepository
{
    public function findByName(string $name)
    {
        return Collection::where('name', $name)->get();
    }

    public function index()
    {
        return Collection::all();
    }

    public function findBySlug(string $slug)
    {
        return Collection::where('slug', $slug)->first();
    }

    public function create(array $data)
    {
        return Collection::create($data);
    }
}
