<?php

namespace App\Http\Controllers;

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
        return $this->service->index();
    }

    public function create()
    {
        return $this->service->create([]);
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
}
