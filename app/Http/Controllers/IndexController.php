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

    public function search(Request $request)
    {
        $data = $request->validate(['find' => ['string', 'nullable']]);
        if (!isset($data)) {
            $data['find'] = null;
        }
        return view('pages.search', $this->service->find($data['find']));
    }

    // public function filter(Request $request)
    // {
    //     $data = $request->validate([
    //         'genre' => 'string',
    //         'language' => 'string',
    //         'type' => 'string',
    //     ]);

    //     return $this->service->filter($data);
    // }
}
