<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function index()
    {
        return Subscription::all();
    }
}
