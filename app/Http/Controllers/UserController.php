<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showForm()
    {
        if (Session::has('user_name')) {
            return redirect()->route('dashboard');
        }

        return view('user.form');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $userName = $validated['user_name'];
        $userName = strtolower($userName);
        $userName = str_replace(' ', '', $userName);

        $user = User::firstOrCreate(
            ['user_name' => $userName],
            [
                'balance' => 0,
                'daily_limit' => $request->daily_limit ?? 0,
                'weekly_limit' => $request->weekly_limit ?? 0,
                'monthly_limit' => $request->monthly_limit ?? 0,
            ]
        );

        if ($user->wasRecentlyCreated === false && ($request->daily_limit || $request->weekly_limit || $request->monthly_limit)) {
            if ($request->daily_limit) $user->daily_limit = $request->daily_limit;
            if ($request->weekly_limit) $user->weekly_limit = $request->weekly_limit;
            if ($request->monthly_limit) $user->monthly_limit = $request->monthly_limit;
            $user->save();
        }

        Session::put('user_name', $userName);

        return redirect()->route('dashboard');
    }

    public function getUsersListInJsonFormat()
    {
        $users = User::all();
        return response()->json($users);
    }
}
