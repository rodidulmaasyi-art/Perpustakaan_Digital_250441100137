@php
    $roleName = Auth::user()->getRoleNames()->first() ?? Auth::user()->role;

    $isKatalogActive = request()->routeIs('buku.index');
    $isKelolaBukuActive = request()->routeIs('buku.kelola', 'buku.create', 'buku.edit');
    $isPeminjamanActive = request()->routeIs('peminjaman.index');
    $isRiwayatActive = request()->routeIs('peminjaman.riwayat');
    $isUsersActive = request()->routeIs('users.*');
    $isLaporanActive = request()->routeIs('laporan.index');
@endphp

<div>
    <!-- Sidebar Desktop di Pinggir Kiri (Bisa Buka-Tutup via sidebarOpen) -->
    <aside
        :class="sidebarOpen ? 'md:w-64' : 'md:w-20'"
        class="hidden md:flex md:flex-col md:fixed md:inset-y-0 md:left-0 z-30 bg-[#06215c] text-white border-r border-[#04153b] shadow-xl transition-all duration-200"
    >
        <!-- Brand & Tombol Buka/Tutup -->
        <div class="h-16 px-3.5 flex items-center justify-between gap-2 bg-[#04153b] border-b border-white/10">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 min-w-0 overflow-hidden">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-500/20 text-emerald-400 ring-1 ring-emerald-400/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div x-show="sidebarOpen" x-transition.opacity class="truncate">
                    <div class="text-sm font-extrabold tracking-wide text-white truncate">
                        Perpustakaan
                    </div>
                    <div class="text-[11px] font-semibold text-emerald-300 tracking-wider truncate">
                        NIM · 250441100137
                    </div>
                </div>
            </a>

            <button
                type="button"
                @click="sidebarOpen = ! sidebarOpen"
                :title="sidebarOpen ? 'Tutup Sidebar' : 'Buka Sidebar'"
                class="shrink-0 inline-flex items-center justify-center p-1.5 rounded-lg text-blue-100/80 hover:text-white hover:bg-white/10 focus:outline-none transition"
            >
                <svg :class="sidebarOpen ? '' : 'rotate-180'" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <!-- Daftar Menu Samping -->
        <div class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            <div x-show="sidebarOpen" class="px-3 pb-1.5 text-[10px] font-bold uppercase tracking-widest text-blue-200/60">
                Menu Utama
            </div>

            {{-- Dashboard Menu --}}
            @can('Akses dashboard admin')
                <a href="{{ route('admin.dashboard') }}"
                   title="Dashboard Admin"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Dashboard Admin') }}</span>
                </a>
            @endcan

            @can('Akses dashboard petugas')
                <a href="{{ route('petugas.dashboard') }}"
                   title="Dashboard Petugas"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('petugas.dashboard') ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Dashboard Petugas') }}</span>
                </a>
            @endcan

            @if(!Auth::user()->can('Akses dashboard admin') && !Auth::user()->can('Akses dashboard petugas'))
                <a href="{{ route('dashboard') }}"
                   title="Dashboard Siswa"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Dashboard Siswa') }}</span>
                </a>
            @endif

            {{-- Katalog Buku (Semua Role) --}}
            @can('Lihat daftar buku')
                <a href="{{ route('buku.index') }}"
                   title="Katalog Buku"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isKatalogActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Katalog Buku') }}</span>
                </a>
            @endcan

            {{-- Kelola Buku (Admin & Petugas) --}}
            @can('Kelola data buku')
                <a href="{{ route('buku.kelola') }}"
                   title="Kelola Buku"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isKelolaBukuActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Kelola Buku') }}</span>
                </a>
            @endcan

            {{-- Kelola Peminjaman (Admin & Petugas) --}}
            @can('Kelola peminjaman')
                <a href="{{ route('peminjaman.index') }}"
                   title="Kelola Peminjaman"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isPeminjamanActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Kelola Peminjaman') }}</span>
                </a>
            @endcan

            {{-- Riwayat Peminjaman (Siswa / Semua Role) --}}
            @can('Melihat riwayat peminjaman sendiri')
                <a href="{{ route('peminjaman.riwayat') }}"
                   title="Riwayat Peminjaman"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isRiwayatActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Riwayat Peminjaman') }}</span>
                </a>
            @endcan

            {{-- Kelola Pengguna & Role (Admin Saja) --}}
            @can('Kelola data pengguna')
                <a href="{{ route('users.index') }}"
                   title="Pengguna & Role"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isUsersActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Pengguna & Role') }}</span>
                </a>
            @endcan

            {{-- Laporan Perpustakaan (Admin & Petugas) --}}
            @can('Lihat laporan perpustakaan')
                <a href="{{ route('laporan.index') }}"
                   title="Laporan"
                   :class="sidebarOpen ? 'justify-start px-3' : 'justify-center px-2'"
                   class="flex items-center gap-3 py-2.5 rounded-lg text-sm font-semibold transition {{ $isLaporanActive ? 'bg-emerald-600 text-white shadow-sm' : 'text-blue-100/85 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span x-show="sidebarOpen" class="truncate">{{ __('Laporan') }}</span>
                </a>
            @endcan
        </div>

        <!-- Info User di Bagian Bawah Sidebar -->
        <div class="p-3.5 bg-[#04153b] border-t border-white/10">
            <div class="flex items-center justify-between gap-2">
                <div x-show="sidebarOpen" class="min-w-0">
                    <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="text-[11px] text-blue-200/75 truncate">{{ Auth::user()->email }}</div>
                </div>
                <span class="shrink-0 mx-auto md:mx-0 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                    {{ $roleName }}
                </span>
            </div>
        </div>
    </aside>

    <!-- Topbar Ringkas di Atas Area Konten (Tombol Buka/Tutup + Mobile Menu + Badge Role + Profil) -->
    <div class="h-16 bg-white border-b-4 border-b-emerald-500 px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4 shadow-2xs">
        <div class="flex items-center gap-3">
            <!-- Tombol Buka/Tutup Sidebar di Desktop -->
            <button
                type="button"
                @click="sidebarOpen = ! sidebarOpen"
                :title="sidebarOpen ? 'Tutup Sidebar' : 'Buka Sidebar'"
                class="hidden md:inline-flex items-center justify-center p-2 rounded-lg border border-slate-200 text-[#06215c] hover:bg-slate-100 focus:outline-none transition"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Hamburger Mobile -->
            <button @click="open = ! open" class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-[#06215c] hover:bg-slate-100 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <span class="md:hidden font-extrabold text-sm text-[#06215c]">
                Perpustakaan Digital
            </span>

            <span class="hidden md:inline-flex items-center gap-2 text-xs font-semibold text-slate-500">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Sistem Perpustakaan Digital · 250441100137
            </span>
        </div>

        <!-- Badge Role & Dropdown Profil -->
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider
                @if($roleName === 'admin') bg-[#06215c]/10 text-[#06215c] border border-[#06215c]/20
                @elseif($roleName === 'petugas') bg-amber-50 text-amber-800 border border-amber-200
                @else bg-emerald-50 text-emerald-700 border border-emerald-200 @endif">
                {{ $roleName }}
            </span>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-1.5 border border-slate-300 text-sm leading-5 font-semibold rounded-lg text-slate-800 bg-white hover:bg-slate-50 focus:outline-none transition">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1.5 text-slate-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @can('Lihat profil sendiri')
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Keluar (Log Out)') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Menu Samping Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-[#06215c] text-white border-b-4 border-emerald-500">
        <div class="pt-2 pb-3 space-y-1 px-3">
            @can('Akses dashboard admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
            @endcan

            @can('Akses dashboard petugas')
                <x-responsive-nav-link :href="route('petugas.dashboard')" :active="request()->routeIs('petugas.dashboard')">
                    {{ __('Dashboard Petugas') }}
                </x-responsive-nav-link>
            @endcan

            @if(!Auth::user()->can('Akses dashboard admin') && !Auth::user()->can('Akses dashboard petugas'))
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard Siswa') }}
                </x-responsive-nav-link>
            @endif

            @can('Lihat daftar buku')
                <x-responsive-nav-link :href="route('buku.index')" :active="$isKatalogActive">
                    {{ __('Katalog Buku') }}
                </x-responsive-nav-link>
            @endcan

            @can('Kelola data buku')
                <x-responsive-nav-link :href="route('buku.kelola')" :active="$isKelolaBukuActive">
                    {{ __('Kelola Buku') }}
                </x-responsive-nav-link>
            @endcan

            @can('Kelola peminjaman')
                <x-responsive-nav-link :href="route('peminjaman.index')" :active="$isPeminjamanActive">
                    {{ __('Kelola Peminjaman') }}
                </x-responsive-nav-link>
            @endcan

            @can('Melihat riwayat peminjaman sendiri')
                <x-responsive-nav-link :href="route('peminjaman.riwayat')" :active="$isRiwayatActive">
                    {{ __('Riwayat Peminjaman') }}
                </x-responsive-nav-link>
            @endcan

            @can('Kelola data pengguna')
                <x-responsive-nav-link :href="route('users.index')" :active="$isUsersActive">
                    {{ __('Pengguna & Role') }}
                </x-responsive-nav-link>
            @endcan

            @can('Lihat laporan perpustakaan')
                <x-responsive-nav-link :href="route('laporan.index')" :active="$isLaporanActive">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <div class="pt-3 pb-3 border-t border-white/10 px-4">
            <div class="mb-2">
                <div class="font-bold text-sm text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-blue-200/75">{{ Auth::user()->email }} ({{ strtoupper($roleName) }})</div>
            </div>

            <div class="mt-2 space-y-1">
                @can('Lihat profil sendiri')
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>
                @endcan

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar (Log Out)') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</div>