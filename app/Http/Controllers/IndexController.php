<?php

namespace App\Http\Controllers;

use App\Services\IndexService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private IndexService $service;

    public function __construct() {
        $this->service = new IndexService();
    }

    public function index()
    {
        return view('pages.index', $this->service->index());
    }

    public function search(string $find)
    {
        return $this->service->find($find);
    }
}
