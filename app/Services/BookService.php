<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\FileRepository;
use App\Repositories\GenreRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookService extends BaseService
{
    private BookRepository $repository;
    private AuthorRepository $authorRepository;
    private GenreRepository $genreRepository;

    public function __construct() {
        $this->repository = new BookRepository();
        $this->authorRepository = new AuthorRepository();
        $this->genreRepository = new GenreRepository();
    }

    public function info(string $slug)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $authorsIds = [];
        foreach ($book->authors as $author) {
            $authorsIds[] = $author->id;
        }
        $authorBooks = $this->repository->authorsOtherBooks($book->id, $authorsIds);
        $data = [
            'authors_books' => $authorBooks,
            'book' => $book,
        ];
        return $data;
    }

    public function prepareRedact(string $slug = null)
    {
        if ($slug !== null) {
            $book = $this->repository->bookBySlug($slug);
            if (!$book) {
                return $this->errNotFound('Книга не найдена');
            }

            $data = [
                'book' => $book,
            ];
            return $data;
        }
        return null;
    }

    public function create(array $data)
    {
        $user = Auth::guard('web-user')->user();
        if (!$user?->admin) {
            return $this->errFobidden('Вы не являетесь администратором');
        }

        $data['slug'] = $data['name'].date('-Y-m-d-h-i-sa');
        if(isset($data['cover'])) {
            $path = $data['cover']->store('public/book/'.$data['slug'].'/cover');
            $data['cover_path'] = Storage::url($path);
        }

        $path = $data['text_file']->store('public/book/'.$data['slug'].'/text');
        $fileArr = file($path) or exit("Unable to open file!");
        $lines = count($fileArr);
        $data['pages_count'] = round((float) $lines / 20);

        $book = $this->repository->create($data);
        File::create([
            'book_id' => $book->id,
            'file_type' => 'русский',
            'path' => Storage::url($path),
        ]);

        $authors = array();
        foreach(explode(", ", $data['authors']) as $author)
        {
            $authorRaw = explode(' ', $author);
            $authorEdited = [
                'name' => $authorRaw[0],
                'surname' => $authorRaw[1]
            ];
            array_push($authors, $authorEdited);
        }
        $authorsIds = $this->authorRepository->getIds($authors);
        $book->authors()->attach($authorsIds);

        $genres = explode(", ", $data['genres']);
        $genresIds = $this->genreRepository->getIds($genres);
        $book->genres()->attach($genresIds);

        return true;
    }

    public function update(array $data)
    {
        $book = $this->repository->bookBySlug($data['slug']);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        File::where('book_id', $book->id)
            ->where('file_type', 'русский')
            ->first()
            ->delete();

        $data['slug'] = $data['name'].date('-Y-m-d-h-i-sa');
        if(isset($data['cover'])) {
            $path = $data['cover']->store('public/book/'.$data['slug'].'/cover');
            $data['cover_path'] = Storage::url($path);
        }

        $path = $data['text_file']->store('public/book/'.$data['slug'].'/text');
        $fileArr = file($path) or exit("Unable to open file!");
        $lines = count($fileArr);
        $data['pages_count'] = round((float) $lines / 20);

        $book->update($data);

        File::create([
            'book_id' => $book->id,
            'file_type' => 'русский',
            'path' => Storage::url($path),
        ]);

        $authors = array();
        foreach(explode(", ", $data['authors']) as $author)
        {
            $authorRaw = explode(' ', $author);
            $authorEdited = [
                'name' => $authorRaw[0],
                'surname' => $authorRaw[1]
            ];
            array_push($authors, $authorEdited);
        }
        $authorsIds = $this->authorRepository->getIds($authors);
        $book->authors->detach();
        $book->authors()->attach($authorsIds);

        $genres = explode(", ", $data['genres']);
        $genresIds = $this->genreRepository->getIds($genres);
        $book->authors->detach();
        $book->genres()->attach($genresIds);

        return true;
    }

    public function read(string $slug, int $page = 1, string $type = 'русский', bool $fragment = false)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        if ($type != 'русский') {
            $fragment = false;
        }
        if ($fragment) {
            $page = 1;
        }

        $content = array();
        $fileArr = file($book->files()->where('file_type', $type)->path) or exit("Unable to open file!");

        $lineCount = count($fileArr);
        $pageCount = round((float) $lineCount / 20);

        for ($i = ($page - 1) * 20; $i < $page * 20; $i++) {
            array_push($content, $fileArr[$i]);
        }

        $data = [
            'fragment' => $fragment,
            'content' => $content,
            'page_count' => $pageCount
        ];

        return $data;
    }

    public function delete(string $slug)
    {
        $book = $this->repository->bookBySlug($slug);
        if (!$book) {
            return $this->errNotFound('Книга не найдена');
        }

        $book->delete();
        return true;
    }

    public function addFile(array $data)
    {
        $file = File::where('book_id', $data['book_id'])
            ->where('file_type', $data['file_type'])
            ->first();

        if ($file) {
            return $this->errNotAcceptable('Файл с таким типом уже существует');
        }

        $path = $data['file']->store('public/book/'.$data['slug'].'/text');
        File::create([
            'book_id' => $data['book_id'],
            'file_type' => $data['file_type'],
            'path' => Storage::url($path),
        ]);

        return true;
    }

    public function removeFile(int $fileId)
    {
        $file = File::find($fileId);
        if (!$file) {
            return $this->errNotFound('Файл не найден');
        }

        $file->delete();
        return true;
    }
}
