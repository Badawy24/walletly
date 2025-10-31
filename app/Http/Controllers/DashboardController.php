<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $user = $this->getAuthenticatedUser();

        $this->recalculateBalance($user);

        $periods = $this->getDatePeriods();

        $todaySpending = $this->calculateTodaySpending($user, $periods['today']);
        $weekSpending = $this->calculateWeekSpending($user, $periods['weekStart'], $periods['weekEnd']);
        $monthSpending = $this->calculateMonthSpending($user, $periods['monthStart'], $periods['monthEnd']);

        $totalBalance = (float) $user->balance;

        return view('dashboard.index', compact(
            'user',
            'totalBalance',
            'todaySpending',
            'weekSpending',
            'monthSpending'
        ));
    }
}
