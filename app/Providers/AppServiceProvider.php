<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $alerts = [];

            if (Session::has('user_name')) {
                $user = User::where('user_name', Session::get('user_name'))->first();

                if ($user) {
                    $alerts = $this->getLimitAlerts($user);
                }
            }

            $view->with('alerts', $alerts);
        });
    }

    private function getLimitAlerts(User $user): array
    {
        $alerts = [];

        $today = now()->startOfDay();
        $weekStart = now()->startOfWeek(CarbonInterface::SATURDAY)->startOfDay();
        $weekEnd = $weekStart->copy()->addDays(6)->endOfDay();
        $monthStart = now()->startOfMonth()->startOfDay();
        $monthEnd = now()->endOfMonth()->endOfDay();

        $dailySpending = $user->expenses()
            ->whereDate('date', $today->toDateString())
            ->sum('amount');

        $weeklySpending = $user->expenses()
            ->where('date', '>=', $weekStart->toDateString())
            ->where('date', '<=', $weekEnd->toDateString())
            ->sum('amount');

        $monthlySpending = $user->expenses()
            ->where('date', '>=', $monthStart->toDateString())
            ->where('date', '<=', $monthEnd->toDateString())
            ->sum('amount');

        if ($user->daily_limit > 0) {
            $dailySpending = (float) $dailySpending;
            $dailyPercent = ($dailySpending / (float) $user->daily_limit) * 100;
            if ($dailySpending >= (float) $user->daily_limit) {
                $alerts[] = [
                    'type' => 'danger',
                    'title' => "Daily limit exceeded! ",
                    'message' => number_format($dailySpending) . " / " . number_format((int) $user->daily_limit) . " EGP",
                ];
            } elseif ($dailyPercent >= 80) {
                $alerts[] = [
                    'type' => 'warning',
                    'title' => "Daily limit warning: ",
                    'message' => number_format($dailySpending) . " / " . number_format((int) $user->daily_limit) . " EGP",
                ];
            }
        }

        if ($user->weekly_limit > 0) {
            $weeklySpending = (float) $weeklySpending;
            $weeklyPercent = ($weeklySpending / (float) $user->weekly_limit) * 100;
            if ($weeklySpending >= (float) $user->weekly_limit) {
                $alerts[] = [
                    'type' => 'danger',
                    'title' => "Weekly limit exceeded! ",
                    'message' => number_format($weeklySpending) . " / " . number_format((int) $user->weekly_limit) . " EGP",
                ];
            } elseif ($weeklyPercent >= 80) {
                $alerts[] = [
                    'type' => 'warning',
                    'title' => "Weekly limit warning: ",
                    'message' => number_format($weeklySpending) . " / " . number_format((int) $user->weekly_limit) . " EGP",
                ];
            }
        }

        if ($user->monthly_limit > 0) {
            $monthlySpending = (float) $monthlySpending;
            $monthlyPercent = ($monthlySpending / (float) $user->monthly_limit) * 100;
            if ($monthlySpending >= (float) $user->monthly_limit) {
                $alerts[] = [
                    'type' => 'danger',
                    'title' => "Monthly limit exceeded! ",
                    'message' => number_format($monthlySpending) . " / " . number_format((int) $user->monthly_limit) . " EGP",
                ];
            } elseif ($monthlyPercent >= 80) {
                $alerts[] = [
                    'type' => 'warning',
                    'title' => "Monthly limit warning: ",
                    'message' => number_format($monthlySpending) . " / " . number_format((int) $user->monthly_limit) . " EGP",
                ];
            }
        }

        return $alerts;
    }
}
