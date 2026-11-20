<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan Digital') }} - 250441100137</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-[#f1f5f9] min-h-screen flex flex-col">
        <!-- Top Bar Bernuansa Navy ala Portal Perpustakaan -->
        <header class="w-full bg-[#06215c] text-white border-b-4 border-emerald-500 shadow-md">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white/10 ring-1 ring-white/20">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="truncate">
                        <div class="text-sm sm:text-base font-bold tracking-wide uppercase truncate">
                            Perpustakaan Digital
                        </div>
                        <div class="hidden sm:block text-[11px] text-blue-200/90 tracking-wide">
                            Layanan Literasi &amp; Manajemen Koleksi Terpadu
                        </div>
                    </div>
                </div>

                <div class="shrink-0 inline-flex items-center gap-2 rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-bold tracking-wider text-white shadow-sm">
                    <span>NIM · 250441100137</span>
                </div>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="flex-1 flex flex-col justify-center items-center px-4 py-8 sm:px-6 lg:px-8">
            <div class="w-full max-w-6xl">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer Singkat -->
        <footer class="w-full bg-[#06215c] text-blue-200/80 text-xs py-3.5 px-4 text-center">
            Perpustakaan Digital · NIM 250441100137
        </footer>
    </body>
</html>