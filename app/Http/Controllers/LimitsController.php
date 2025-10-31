<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LimitsController extends Controller
{
    public function index()
    {
        if (!Session::has('user_name')) {
            return redirect()->route('user.form');
        }

        $user = User::where('user_name', Session::get('user_name'))->firstOrFail();

        return view('limits.index', compact('user'));
    }

    public function update(LimitRequest $request)
    {
        if (!Session::has('user_name')) {
            return redirect()->route('user.form');
        }

        $user = User::where('user_name', Session::get('user_name'))->firstOrFail();

        if ($request->user_name !== $user->user_name) {
            $existingUser = User::where('user_name', $request->user_name)->where('id', '!=', $user->id)->first();
            if ($existingUser) {
                return redirect()->route('limits.index')
                    ->withErrors(['user_name' => 'This user name is already taken. Please choose another one.']);
            }

            $user->user_name = $request->user_name;
            Session::put('user_name', $request->user_name);
        }

        $user->daily_limit = $request->daily_limit ?? 0;
        $user->weekly_limit = $request->weekly_limit ?? 0;
        $user->monthly_limit = $request->monthly_limit ?? 0;

        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Limits updated successfully!');
    }
}
