<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Genre;
use App\Services\CollectionService;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    private CollectionService $service;

    public function __construct() {
        $this->service = new CollectionService();
    }

    public function index()
    {
        $genres = Genre::all();
        $collections = Collection::all();

        return view('pages.catalog', [
            'genres' => $genres,
            'collections' => $collections,
        ]);
    }

    public function goCreate(string $slug = null)
    {
        if ($slug != null) {
            return view('pages.admin.create-collection', $this->service->prepareRedact($slug));
        }
        return view('pages.admin.create-collection', ['collection' => null]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'cover' => 'file',
        ]);
        return $this->service->create($data);
    }

    public function info(string $slug)
    {
        return $this->service->info($slug);
    }

    public function addBook()
    {
        return $this->service->addBook([]);
    }

    public function removeBook()
    {
        return $this->service->removeBook([]);
    }

    public function delete()
    {

    }

    public function update()
    {
        return 1;
    }
}
