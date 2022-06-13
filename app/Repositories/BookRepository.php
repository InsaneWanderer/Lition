<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function index(array $params = [])
    {
        $query = Book::query();
        return $query->get();
    }

    public function getAudio(Book $book)
    {
        return $book->files()->where('file_type', 'аудио')->get();
    }

    public function bookById(int $id)
    {
        return Book::find($id);
    }

    public function bookBySlug(string $slug)
    {
        return Book::where('slug', $slug)->first();
    }

    public function authorsOtherBooks(int $bookId ,array $ids)
    {
        return Book::join('book_authors', 'books.id', '=', 'book_authors.book_id')
            ->whereIn('book_authors.author_id', $ids)
            ->whereNot('books.id', $bookId)
            ->get();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function findByName(string $name)
    {
        return Book::where('name', $name)->get();
    }

    public function findByAuthorParam(string $find)
    {
        return Book::whereHas('authors', function ($query) use($find) {
            $query->where('name', $find)
                ->orWhere('surname', $find);
        })->get();
        // return Book::join('book_authors', 'books.id', '=', 'book_authors.book_id')
        //     ->join('authors', 'author.id', '=', 'book_authors.author_id')
        //     ->where('authors.name', $name)
        //     ->get();
    }

    public function findByAuthor(string $str1, string $str2)
    {
        return Book::whereHas('authors', function ($query) use($str1, $str2) {
            $query->where(function ($q) use ($str1, $str2) {
                $q->where('name', $str1)
                    ->where('surname', $str2);
                })
                ->orWhere(function ($q) use ($str1, $str2) {
                    $q->where('name', $str2)
                        ->where('surname', $str1);
                });
        })->get();
    }

    // public function filter(array $data)
    // {
    //     $query = Book::query();
    //     if (!isset($data['genre'])) {
    //         $query->join('book_genres', 'book_genres.book_id', '=', 'books.id')
    //             ->join('genres', 'genres.id', '=', 'book_genres.genre_id')
    //             ->where('genres.name', '=', $data['genre']);
    //     }

    //     if (!isset($data['language']) || !isset($data['type'])) {
    //         $query->join('files', 'files.book_id', '=', 'books.id');

    //         if (!isset($data['language'])) {
    //             $query->where('files.type', '=', $data['language']);
    //         }

    //         if (!isset($data['type'])) {
    //             if ($data['type'] == 'аудио') {
    //                 $query->where('files.type', '=', 'аудио');
    //             }
    //             else {
    //                 $query->whereNot('files.type', '=', 'аудио');
    //             }
    //         }
    //     }

    //     if (!isset($data['collection_id'])) {
    //         $query->join('collection_books', 'files.book_id', '=', 'books.id')
    //     }
    // }
}
