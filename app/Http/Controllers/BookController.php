<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Rules\AuthorRule;
use App\Rules\GenreRule;
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

    public function create(CreateBookRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->create($data);
        if ($result) {
            return redirect(route('index'));
        }
        else {
            return abort(404, "Что-то пошло не так...");
        }
    }

    public function update(UpdateBookRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->update($data);
        if ($result) {
            return redirect(route('index'));
        }
        else {
            return abort(404, "Что-то пошло не так...");
        }
    }

    public function read(string $slug, int $page, string $type, bool $fragment = false)
    {
        return view('pages.reader', $this->service->read($slug, $page, $type, $fragment));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return redirect('/');
    }

    public function editFiles(string $slug, Request $request)
    {
        $data = $request->validate([
            'files' => 'array',
            'files.*' => 'file|required',
            'types' => 'array',
            'types.*' => 'string|required'
        ]);

        return $this->service->editFiles($slug, $data);
    }

    public function filesControl(string $slug)
    {
        return view('pages.admin.book-files-control', $this->service->prepareControl($slug));
    }
}
