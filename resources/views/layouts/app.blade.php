<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Rental') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 flex flex-col min-h-screen">
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-indigo-600">
                        <span class="text-2xl">🚗</span>
                        <span>CarRental</span>
                    </a>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ url('/') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition-colors">Home</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-sm px-3 py-1.5 rounded-lg transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm transition-colors">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-slate-400 text-xs">
        <p>&copy; {{ date('Y') }} CarRental System. All rights reserved.</p>
    </footer>
</body>
</html>
