<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetActiveUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('user_name')) {
            $userName = Session::get('user_name');
            $user = User::where('user_name', $userName)->first();

            if ($user) {
                $request->merge(['active_user' => $user]);
                view()->share('activeUser', $user);
            }
        }

        return $next($request);
    }
}
