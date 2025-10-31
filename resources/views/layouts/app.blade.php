<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Expense Tracker'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('build/assets/style.css') }}">
</head>

<body class="bg-light">
    <div class="container-fluid px-0">
        <div class="main-container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container-fluid px-3 px-md-4">
                <div class="row justify-content-center">
                    <div class="col-12">
                        @if (!empty($alerts))
                            @foreach ($alerts as $alert)
                                <div class="alert alert-{{ $alert['type'] }} border-0 mb-4" role="alert">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4 me-3">{{ $alert['type'] === 'danger' ? '🚫' : '⚡' }}</span>
                                        <div><strong>{{ $alert['title'] }}</strong><br> {{ $alert['message'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>

</html>
