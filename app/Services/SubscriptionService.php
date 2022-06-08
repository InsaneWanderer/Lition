<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;

class SubscriptionService extends BaseService
{
    private SubscriptionRepository $repository;

    public function __construct() {
        $this->repository = new SubscriptionRepository();
    }

    public function index()
    {
        $data = ['subscriptions' => $this->repository->index()];
        return $data;
    }

    public function setSubscription(array $data)
    {
        $user = Auth::guard('web-user')->user();
        if(!$user) {
            return $this->errNotAcceptable('Нужна авторизация');
        }

    }
}
