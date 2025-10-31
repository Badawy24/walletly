@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0">
                    <div class="card-header bg-primary text-center">
                        <h4 class="card-title mb-0 fw-semibold">⚙️ Settings</h4>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('limits.update') }}" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="user_name" class="form-label fw-semibold">
                                    👤 User Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                    id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}"
                                    placeholder="Enter your user name" maxlength="255" required>
                                @error('user_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">📊 Spending Limits</h5>
                                <div class="mb-4">
                                    <label for="daily_limit" class="form-label fw-semibold">
                                        📅 Daily Limit
                                    </label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('daily_limit') is-invalid @enderror" id="daily_limit"
                                            name="daily_limit" value="{{ old('daily_limit', $user->daily_limit) }}"
                                            placeholder="0.00">
                                        <span class="input-group-text bg-light fw-semibold">EGP</span>
                                        @error('daily_limit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted mt-1">Amount you want spend per day.</small>
                                </div>

                                <div class="mb-4">
                                    <label for="weekly_limit" class="form-label fw-semibold">
                                        📆 Weekly Limit
                                    </label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('weekly_limit') is-invalid @enderror"
                                            id="weekly_limit" name="weekly_limit"
                                            value="{{ old('weekly_limit', $user->weekly_limit) }}" placeholder="0.00">
                                        <span class="input-group-text bg-light fw-semibold">EGP</span>
                                        @error('weekly_limit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted mt-1">Amount you want spend per week.</small>
                                </div>

                                <div class="mb-4">
                                    <label for="monthly_limit" class="form-label fw-semibold">
                                        🗓️ Monthly Limit
                                    </label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('monthly_limit') is-invalid @enderror"
                                            id="monthly_limit" name="monthly_limit"
                                            value="{{ old('monthly_limit', $user->monthly_limit) }}" placeholder="0.00">
                                        <span class="input-group-text bg-light fw-semibold">EGP</span>
                                        @error('monthly_limit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted mt-1">Amount you want spend per
                                        month.</small>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-md">
                                    💾 Save
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
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
