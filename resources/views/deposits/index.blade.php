@extends('layouts.app')

@section('title', 'My Deposits')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row mb-4">
        <div class="col-12">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        ← Dashboard
                    </a>
                    <a href="{{ route('deposits.create') }}" class="btn btn-success">
                        ➕ Add Deposit
                    </a>
                </div>
            </div>
            @include('components.transactions-nav')

        </div>
    </div>

    @include('components.transactions-summary', [
        'user' => $user,
        'type' => 'deposits',
        'monthDeposits' => $monthDeposits ?? 0
    ])

    @if($deposits->count() > 0)
        <div class="card border-0">
            <div class="card-header balance-card-success">
                <h5 class="mb-0 fw-semibold">Recent Deposits</h5>
            </div>

            <!-- Mobile Card View (visible on mobile, hidden on desktop) -->
            <div class="card-body p-3 d-md-none">
                @foreach($deposits as $deposit)
                    <div class="card mb-3 border shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong class="d-block text-muted small mb-1">Date</strong>
                                    <strong>{{ $deposit->date->format('D, M d, Y') }}</strong>
                                </div>
                                <div class="text-end">
                                    <div>
                                        <span class="fw-bold text-success-color amount-large">+{{ number_format($deposit->amount, 2) }} EGP</span>
                                    </div>
                                </div>
                            </div>
                            @if($deposit->notes)
                                <div class="mt-2 pt-2 border-top">
                                    <strong class="text-muted small d-block mb-1">Notes</strong>
                                    <span class="text-muted small">{{ $deposit->notes }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View (hidden on mobile, visible on desktop) -->
            <div class="card-body p-0 d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Date</th>
                                <th>Amount</th>
                                <th class="pe-4">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td class="ps-4">
                                        <strong>{{ $deposit->date->format('D, M, d') }}</strong>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success-color amount-large">+{{ number_format($deposit->amount, 2) }} EGP</span>
                                    </td>
                                    <td class="text-muted small pe-4">{{ $deposit->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-center">
                    {{ $deposits->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
