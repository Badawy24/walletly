<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\User;

class ExpenseController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();
        $expenses = $user->expenses()->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(20);

        $this->recalculateBalance($user);

        $periods = $this->getDatePeriods();

        $todayExpenses = $this->calculateTodaySpending($user, $periods['today']);
        $weekExpenses = $this->calculateWeekSpending($user, $periods['weekStart'], $periods['weekEnd']);
        $monthExpenses = $this->calculateMonthSpending($user, $periods['monthStart'], $periods['monthEnd']);

        return view('expenses.index', compact(
            'expenses',
            'user',
            'todayExpenses',
            'weekExpenses',
            'monthExpenses'
        ));
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();

        return view('expenses.create', compact('user'));
    }

    public function store(ExpenseRequest $request)
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();

        Expense::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'category' => $request->category,
            'date' => $request->date ?? now()->toDateString(),
            'notes' => $request->notes,
        ]);

        $this->recalculateBalance($user);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully! Balance updated.');
    }
}
