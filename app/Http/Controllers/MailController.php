<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(MailRequest $request)
    {
        $data = $request->validated();

        Mail::to($data['email'])->send(new NotifyMail($data['code']));
    }
}
