<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private SubscriptionService $service;

    public function __construct() {
        $this->service = new SubscriptionService();
    }

    public function index()
    {
        return view('pages.subscriptions', $this->service->index());
    }

    public function setSubscription(Request $request)
    {
        $id = $request->validate(['sub_id' => 'required|exists:subscriptions,id']);
        return $this->service->setSubscription($id['sub_id']);
    }
}
