<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use App\Models\User;

class DepositController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();
        $deposits = $user->deposits()->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(20);

        $this->recalculateBalance($user);

        $periods = $this->getDatePeriods();
        $monthDeposits = $this->calculateMonthDeposits($user, $periods['monthStart'], $periods['monthEnd']);

        return view('deposits.index', compact(
            'deposits',
            'user',
            'monthDeposits'
        ));
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();

        return view('deposits.create', compact('user'));
    }

    public function store(DepositRequest $request)
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();

        Deposit::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'date' => $request->date ?? now()->toDateString(),
            'notes' => $request->notes,
        ]);

        $this->recalculateBalance($user);

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit added successfully! Balance updated.');
    }
}
