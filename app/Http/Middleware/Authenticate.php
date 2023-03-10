<?php

namespace App\Http\Middleware;

use App\Utils\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use Response;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        return $this->sendFailedResponse([], 'Oops, sepertinya anda harus login ulang', 401);
    }
}
