@extends('layouts.app')

@section('title', 'Add Deposit')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0">
                <div class="card-header bg-success text-center">
                    <h4 class="card-title mb-0 fw-semibold">➕ Add Money</h4>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-success border-0 mb-4">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="h6 mb-0 ms-2"><strong>Current Balance:</strong></span>
                                <span class="h5 mb-0 ms-2">{{ number_format($user->balance, 2) }} EGP</span>
                            </div>
                            <span class="fs-4 me-3">💰</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('deposits.store') }}" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="amount" class="form-label fw-semibold">
                                💵 Amount <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                type="number"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    id="amount"
                                    name="amount"
                                    value="{{ old('amount') }}"
                                    placeholder="0.00"
                                    required
                                    autofocus
                                    >
                                    <span class="input-group-text bg-light fw-semibold">EGP</span>
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-semibold">
                                📅 Date <span class="text-danger">*</span>
                            </label>
                            <input
                                type="date"
                                class="form-control @error('date') is-invalid @enderror"
                                id="date"
                                name="date"
                                value="{{ old('date', now()->toDateString()) }}"
                                required
                            >
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-semibold">
                                📝 Notes
                            </label>
                            <input
                                type="text"
                                class="form-control @error('notes') is-invalid @enderror"
                                id="notes"
                                name="notes"
                                value="{{ old('notes') }}"
                                placeholder="salary, bonus, gift, etc."
                            >
                            @error('notes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-md">
                                ✅ Add
                            </button>
                            <a href="{{ route('deposits.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
