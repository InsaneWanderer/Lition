<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService extends BaseService
{
    private AuthorRepository $repository;

    public function __construct() {
        $this->repository = new AuthorRepository();
    }
}
