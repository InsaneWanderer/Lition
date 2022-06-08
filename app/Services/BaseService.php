<?php

namespace App\Services;

class BaseService
{
    protected function errValidate($message)
    {
        return abort(422, $message);
    }

    protected function errFobidden($message)
    {
        return abort(403, $message);
    }
    protected function errNotFound($message)
    {
        return abort(404, $message);
    }

    protected function errService($message)
    {
        return abort(500, $message);
    }

    protected function errNotAcceptable($message)
    {
        return abort(406, $message);
    }
}
