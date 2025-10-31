<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Session;

abstract class Controller
{
    protected function checkAuth(): ?\Illuminate\Http\RedirectResponse
    {
        if (!Session::has('user_name')) {
            return redirect()->route('user.form');
        }

        return null;
    }

    protected function getAuthenticatedUser(): User
    {
        return User::where('user_name', Session::get('user_name'))->firstOrFail();
    }

    protected function recalculateBalance(User $user): void
    {
        $totalDeposits = (float) $user->deposits()->sum('amount');
        $totalExpenses = (float) $user->expenses()->sum('amount');
        $realBalance = $totalDeposits - $totalExpenses;

        if (abs((float) $user->balance - $realBalance) > 0.01) {
            $user->update(['balance' => round($realBalance, 2)]);
        }
    }

    protected function getDatePeriods(): array
    {
        $today = now()->startOfDay();
        $weekStart = now()->startOfWeek(CarbonInterface::SATURDAY)->startOfDay();
        $weekEnd = $weekStart->copy()->addDays(6)->endOfDay();
        $monthStart = now()->startOfMonth()->startOfDay();
        $monthEnd = now()->endOfMonth()->endOfDay();

        return [
            'today' => $today,
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'monthStart' => $monthStart,
            'monthEnd' => $monthEnd,
        ];
    }

    protected function calculateTodaySpending(User $user, $today): float
    {
        return (float) $user->expenses()
            ->whereDate('date', $today->toDateString())
            ->sum('amount');
    }

    protected function calculateWeekSpending(User $user, $weekStart, $weekEnd): float
    {
        return (float) $user->expenses()
            ->where('date', '>=', $weekStart->toDateString())
            ->where('date', '<=', $weekEnd->toDateString())
            ->sum('amount');
    }

    protected function calculateMonthSpending(User $user, $monthStart, $monthEnd): float
    {
        return (float) $user->expenses()
            ->where('date', '>=', $monthStart->toDateString())
            ->where('date', '<=', $monthEnd->toDateString())
            ->sum('amount');
    }

    protected function calculateMonthDeposits(User $user, $monthStart, $monthEnd): float
    {
        return (float) $user->deposits()
            ->where('date', '>=', $monthStart->toDateString())
            ->where('date', '<=', $monthEnd->toDateString())
            ->sum('amount');
    }
}
