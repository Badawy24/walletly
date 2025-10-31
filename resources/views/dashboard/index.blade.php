@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid px-3 px-md-4">
        <div class="row g-3 mb-4">
            <div class="col-12">
                <h5 class="fw-bold mb-3">⚡ Quick Actions</h5>
            </div>

            <div class="col-3">
                <a href="{{ route('expenses.create') }}" class="text-decoration-none action-link">
                    <div class="card border-0 text-center action-card-danger">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <span>💰</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="{{ route('deposits.create') }}" class="text-decoration-none action-link">
                    <div class="card border-0 text-center action-card-success">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <span>➕</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="{{ route('expenses.index') }}" class="text-decoration-none action-link">
                    <div class="card border-0 text-center action-card-info">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <span>📊</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="{{ route('limits.index') }}" class="text-decoration-none action-link">
                    <div class="card border-0 text-center action-card-primary">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <span>⚙️</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card border-0 balance-card">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p class="mb-2 text-white-50 small fw-semibold">Current Balance</p>
                                <h2 class="mb-0 fw-bold balance-large">{{ number_format($totalBalance, 2) }} <small
                                        class="fs-6 opacity-75">EGP</small></h2>
                            </div>
                            <div class="col-4 text-end">
                                <div class="fs-1 opacity-90">💸</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <h5 class="fw-bold mb-3">📊 Spending Overview</h5>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 h-100 card-border-primary">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <p class="text-muted mb-0 small fw-semibold">Today's Spending</p>
                                <h4 class="mb-0 fw-bold text-primary-color">{{ number_format($todaySpending, 2) }} <small
                                        class="fs-6 text-muted">EGP</small></h4>
                            </div>
                        </div>
                        @if ($user->daily_limit > 0)
                            @php
                                $todayPercent = min(($todaySpending / (float) $user->daily_limit) * 100, 100);
                                $todayColor =
                                    $todayPercent >= 100 ? 'danger' : ($todayPercent >= 80 ? 'warning' : 'primary');
                            @endphp
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted fw-semibold">Daily Limit</small>
                                    <small
                                        class="fw-bold text-{{ $todayColor }}-color">{{ number_format($todayPercent, 1) }}%</small>
                                </div>
                                <div class="progress progress-height progress-bg-light mb-2">
                                    <div class="progress-bar bg-{{ $todayColor }}" role="progressbar"
                                        style="width: {{ $todayPercent }}%;"></div>
                                </div>
                                <small class="text-muted">{{ number_format($todaySpending, 2) }} /
                                    {{ number_format((float) $user->daily_limit, 2) }} EGP</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 h-100 card-border-info">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <p class="text-muted mb-0 small fw-semibold">This Week</p>
                                <h4 class="mb-0 fw-bold text-info-color">{{ number_format($weekSpending, 2) }} <small
                                        class="fs-6 text-muted">EGP</small></h4>
                            </div>
                        </div>
                        @if ($user->weekly_limit > 0)
                            @php
                                $weekPercent = min(($weekSpending / (float) $user->weekly_limit) * 100, 100);
                                $weekColor = $weekPercent >= 100 ? 'danger' : ($weekPercent >= 80 ? 'warning' : 'info');
                            @endphp
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted fw-semibold">Weekly Limit</small>
                                    <small
                                        class="fw-bold text-{{ $weekColor }}-color">{{ number_format($weekPercent, 1) }}%</small>
                                </div>
                                <div class="progress progress-height progress-bg-light mb-2">
                                    <div class="progress-bar bg-{{ $weekColor }}" role="progressbar"
                                        style="width: {{ $weekPercent }}%;"></div>
                                </div>
                                <small class="text-muted">{{ number_format($weekSpending, 2) }} /
                                    {{ number_format((float) $user->weekly_limit, 2) }} EGP</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 h-100 card-border-warning">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <p class="text-muted mb-0 small fw-semibold">This Month</p>
                                <h4 class="mb-0 fw-bold text-warning-color">{{ number_format($monthSpending, 2) }} <small
                                        class="fs-6 text-muted">EGP</small></h4>
                            </div>
                        </div>
                        @if ($user->monthly_limit > 0)
                            @php
                                $monthPercent = min(($monthSpending / (float) $user->monthly_limit) * 100, 100);
                                $monthColor =
                                    $monthPercent >= 100 ? 'danger' : ($monthPercent >= 80 ? 'warning' : 'warning');
                            @endphp
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <small class="text-muted fw-semibold">Monthly Limit</small>
                                    <small
                                        class="fw-bold text-{{ $monthColor }}-color">{{ number_format($monthPercent, 1) }}%</small>
                                </div>
                                <div class="progress progress-height progress-bg-light mb-2">
                                    <div class="progress-bar bg-{{ $monthColor }}" role="progressbar"
                                        style="width: {{ $monthPercent }}%;"></div>
                                </div>
                                <small class="text-muted">{{ number_format($monthSpending, 2) }} /
                                    {{ number_format((float) $user->monthly_limit, 2) }} EGP</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
