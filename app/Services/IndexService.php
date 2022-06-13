<?php

namespace App\Services;

use App\Models\Book;
use App\Models\File;
use App\Models\Genre;
use App\Repositories\BookRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\GenreRepository;
use App\Repositories\SubscriptionRepository;

class IndexService extends BaseService
{
    private BookRepository $bookRepostitory;
    private SubscriptionRepository $subRepository;

    public function __construct() {
        $this->bookRepostitory = new BookRepository();
        $this->subRepository = new SubscriptionRepository();
        $this->collectionRepository = new CollectionRepository();
    }

    public function index()
    {
        $data = [
            'subscriptions' => $this->subRepository->index(),
            'books' => $this->bookRepostitory->index(),
        ];
        return $data;
    }

    public function find(string $find = null)
    {
        $genres = Genre::all();
        $languages = array();
        $resultString = "";
        if (isset($find)) {
            $books = $this->bookRepostitory->findByName($find);

            foreach ($books as $book) {
                foreach ($book->files as $file) {
                    if ($file->file_type != 'аудио') {
                        array_push($languages, $file->file_type);
                    }
                }
            }
            $resultString = 'Результаты поиска для "'.$find.'"';
        }
        else {
            $resultString = "Все варианты";
            $books = Book::all();
            $files = File::all();
            foreach ($files as $file) {
                if ($file->file_type != 'аудио') {
                    array_push($languages, $file->file_type);
                }
            }
        }

        $data = [
            'result_string' => $resultString,
            'books' => $books,
            'genres' => $genres,
            'languages' => array_unique($languages),
        ];

        return $data;
    }

    // public function filter(array $data)
    // {
    //     $result = [];
    //     if (isset('books')) {
    //         $result['books'] = $this->$
    //     }
    // }
}
