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

    public function setSubscription(int $subId)
    {
        $user = Auth::guard('web-user')->user();
        if(!$user) {
            return $this->errFobidden('Требуется авторизация');
        }
        $user->update(['subscription_id' => $subId, 'sub_end' => substr(date('Y-m-d h:i:sa', strtotime('+1 month')), 0, -2)]);
        return true;
    }
}
