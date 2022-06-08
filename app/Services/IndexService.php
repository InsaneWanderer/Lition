<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\SubscriptionRepository;

class IndexService extends BaseService
{
    private BookRepository $bookRepostitory;
    private SubscriptionRepository $subRepository;
    private CollectionRepository $collectionRepository;

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

    public function find(string $find)
    {
        $arrFind = explode(' ', $find);
        $booksByAuthor = [];
        if (count($arrFind) == 2) {
            $booksByAuthor = $this->bookRepostitory->findByAuthor($arrFind[0], $arrFind[1]);
        }
        else {
            $booksByAuthor = $this->bookRepostitory->findByAuthorParam($find);
        }

        $data = [
            'books' => $this->bookRepostitory->findByName($find),
            'booksByAuthor' => $booksByAuthor,
            'collections' => $this->collectionRepository->findByName($find),
        ];

        return $data;
    }
}
