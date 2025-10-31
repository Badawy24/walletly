@extends('layouts.app')

@section('title', 'Enter Your Name')

@section('content')
<div class="container-fluid px-3">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('user.store') }}" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="user_name" class="form-label fw-semibold">
                                👤 Username <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('user_name') is-invalid @enderror"
                                id="user_name"
                                name="user_name"
                                value="{{ old('user_name') }}"
                                placeholder="Enter your username"
                                autofocus
                                required
                            >
                            @error('user_name')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <!-- Daily Limit -->
                            <div class="mb-3">
                                <label for="daily_limit" class="form-label fw-semibold">
                                    📅 Daily Limit (EGP)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-semibold">EGP</span>
                                    <input
                                        type="number"
                                        class="form-control @error('daily_limit') is-invalid @enderror"
                                        id="daily_limit"
                                        name="daily_limit"
                                        value="{{ old('daily_limit') }}"
                                        placeholder="0.00"
                                    >
                                    @error('daily_limit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Weekly Limit -->
                            <div class="mb-3">
                                <label for="weekly_limit" class="form-label fw-semibold">
                                    📆 Weekly Limit (EGP)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-semibold">EGP</span>
                                    <input
                                        type="number"
                                        class="form-control @error('weekly_limit') is-invalid @enderror"
                                        id="weekly_limit"
                                        name="weekly_limit"
                                        value="{{ old('weekly_limit') }}"
                                        placeholder="0.00"
                                    >
                                    @error('weekly_limit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Monthly Limit -->
                            <div class="mb-4">
                                <label for="monthly_limit" class="form-label fw-semibold">
                                    🗓️ Monthly Limit (EGP)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-semibold">EGP</span>
                                    <input
                                        type="number"
                                        class="form-control @error('monthly_limit') is-invalid @enderror"
                                        id="monthly_limit"
                                        name="monthly_limit"
                                        value="{{ old('monthly_limit') }}"
                                        placeholder="0.00"
                                    >
                                    @error('monthly_limit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            🚀 Continue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
