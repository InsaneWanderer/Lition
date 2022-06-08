<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $service;

    public function __construct() {
        $this->service = new BookService();
    }

    public function index(string $slug)
    {
        return view('pages.book', $this->service->info($slug));
    }

    public function redact(string $slug = null)
    {
        return view('pages.admin.redact-book', $this->service->prepareRedact($slug));
    }

    public function create()
    {
        return $this->service->create([]);
    }

    public function update()
    {
        return $this->service->update([]);
    }

    public function read(string $slug, int $page, bool $fragment = false)
    {
        return $this->service->read($slug, $page, $fragment);
    }

    public function delete(string $slug)
    {
        return $this->service->delete($slug);
    }

    public function addFile()
    {
        return $this->service->addFile([]);
    }

    public function removeFile(int $fileId)
    {
        return $this->service->removeFile($fileId);
    }
}
