<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - Astryx Academy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col h-full shadow-lg z-20">
        <div class="flex items-center justify-center h-20 border-b border-gray-700 bg-white">
            <img src="{{ asset('images/logo-1.jpeg') }}" alt="Astryx Academy" class="h-14 object-contain mix-blend-multiply">
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-800' }} flex items-center gap-3 px-4 py-3 rounded-xl transition">
                <i class="fas fa-chart-pie w-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.*') ? 'bg-indigo-600' : 'hover:bg-gray-800' }} flex items-center gap-3 px-4 py-3 rounded-xl transition">
                <i class="fas fa-book-open w-5"></i>
                <span class="font-medium">Manage Courses</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-indigo-600' : 'hover:bg-gray-800' }} flex items-center gap-3 px-4 py-3 rounded-xl transition">
                <i class="fas fa-users w-5"></i>
                <span class="font-medium">Manage Students</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-left hover:bg-gray-800 rounded-xl transition text-gray-300">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-full relative z-10 overflow-hidden">
        <!-- Top Header -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800">
                @yield('header')
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">Admin: {{ Auth::user()->name }}</span>
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
