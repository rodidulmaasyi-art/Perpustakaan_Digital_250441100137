<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Perpustakaan Digital') }} - 250441100137</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Tailwind & Alpine Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- CSS Kustom Buku dari modul sebelumnya -->
        <link rel="stylesheet" href="{{ asset('css/buku.css') }}">
    </head>
    <body class="font-sans antialiased bg-[#f1f5f9] text-slate-800">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Wrapper Konten Utama di Sebelah Kanan Sidebar -->
            <div class="flex-1 flex flex-col md:pl-64">
                <!-- Flash Message Notification -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
                        <div class="bg-emerald-50 border-l-4 border-emerald-600 p-4 rounded-r-xl shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-emerald-900">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
                        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-r-xl shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 00-1.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-red-900">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-slate-200 shadow-2xs">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 border-l-4 border-[#06215c]">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 py-6">
                    @yield('content')
                    {{ $slot ?? '' }}
                </main>

                <!-- Footer -->
                <footer class="w-full bg-[#06215c] text-blue-100/85 border-t-4 border-emerald-500 py-4 px-4 text-center text-xs">
                    &copy; {{ date('Y') }} Sistem Perpustakaan Digital - PBWL · NIM 250441100137
                </footer>
            </div>
        </div>
    </body>
</html>