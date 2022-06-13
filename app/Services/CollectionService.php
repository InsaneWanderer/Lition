<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\CollectionRepository;
use Illuminate\Support\Facades\Storage;

class CollectionService extends BaseService
{
    private CollectionRepository $repo;

    public function __construct() {
        $this->repo = new CollectionRepository();
    }

    public function index()
    {
        return ['collections' => $this->repo->index()];
    }

    public function info(string $slug)
    {
        $collection = $this->repo->findBySlug($slug);
        if (!$collection) {
            return $this->errNotFound('Подборка не найдена');
        }

        return ['collection' => $collection];
    }

    public function create(array $data)
    {
        $data['slug'] = $data['name'].date('-Y-m-d-h-i-sa');
        if(isset($data['cover'])) {
            $path = $data['cover']->store('public/collection/'.$data['slug']);
            $data['cover_path'] = Storage::url($path);
        }

        $collection = $this->repo->create($data);
        return ['collection' => $collection];
    }

    public function addBook(array $data)
    {
        $collection = $this->repo->findBySlug($data['slug']);
        if (!$collection) {
            return $this->errNotFound('Подборка не найдена');
        }

        $book = Book::find($data['book_id']);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $collection->books()->attach($book->id);

        return true;
    }

    public function removeBook(array $data)
    {
        $collection = $this->repo->findBySlug($data['slug']);
        if (!$collection) {
            return $this->errNotFound('Подборка не найдена');
        }

        $book = Book::find($data['book_id']);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        if (!$collection->books()->find($book->id)) {
            return $this->errFobidden('Книга не пренадлежит данной подборке');
        }

        $collection->books()->detach($book->id);

        return true;
    }

    public function prepareRedact(string $slug)
    {
        $collection = $this->repo->findBySlug($slug);
        if (!$collection) {
            return $this->errNotFound('Подборка не найдена');
        }

        return ['collection', $collection];
    }
}
