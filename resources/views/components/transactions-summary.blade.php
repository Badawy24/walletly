@props([
    'user',
    'type' => 'expenses',
    'todayExpenses' => 0,
    'weekExpenses' => 0,
    'monthExpenses' => 0,
    'monthDeposits' => 0,
])

<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 {{ $type === 'expenses' ? 'balance-card-danger' : 'balance-card-success' }}">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-8">
                        <p class="mb-2 text-white-50 small fw-semibold">Current Balance</p>
                        <h2 class="mb-0 fw-bold balance-large">{{ number_format($user->balance, 2) }}
                            <small class="fs-6 opacity-75">EGP</small>
                        </h2>
                    </div>
                    <div class="col-4 text-end">
                        <div class="fs-1 opacity-90">
                            {{ $type === 'expenses' ? '💸' : '💰' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($type === 'expenses')
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 h-100 card-border-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <p class="text-muted mb-0 small fw-semibold">Today's Expenses</p>
                            <h4 class="mb-0 fw-bold text-primary-color">
                                -{{ number_format($todayExpenses, 2) }} <small class="fs-6 text-muted">EGP</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 h-100 card-border-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <p class="text-muted mb-0 small fw-semibold">This Week</p>
                            <h4 class="mb-0 fw-bold text-info-color">
                                -{{ number_format($weekExpenses, 2) }} <small class="fs-6 text-muted">EGP</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 h-100 card-border-danger">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <p class="text-muted mb-0 small fw-semibold">This Month</p>
                            <h4 class="mb-0 fw-bold text-danger-color">
                                -{{ number_format($monthExpenses, 2) }} <small class="fs-6 text-muted">EGP</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 h-100 card-border-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <p class="text-muted mb-0 small fw-semibold">This Month's Deposits</p>
                            <h4 class="mb-0 fw-bold text-success-color">
                                +{{ number_format($monthDeposits, 2) }} <small class="fs-6 text-muted">EGP</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
