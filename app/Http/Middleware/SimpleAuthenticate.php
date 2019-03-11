<?php
namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpleAuthenticate
{
    public function handle($request, Closure $next)
    {
        /**
         * @var Request $request
         */
        $user = $request->hasHeader('user_id') ? User::find($request->header('user_id')) : null;

        if (!empty($user)) {
            Auth::login($user);
        }

        return $next($request);
    }
}
