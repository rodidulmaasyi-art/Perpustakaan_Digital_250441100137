@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    <!-- Flash Message -->
    @if (session('success'))
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm font-semibold text-emerald-800 flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header Katalog -->
    <div class="bg-white rounded-2xl border border-slate-200 border-t-4 border-t-[#06215c] p-5 sm:p-6 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                Katalog Koleksi &middot; 250441100137
            </div>
            <h1 class="text-2xl font-extrabold text-[#06215c] tracking-tight">
                Katalog Buku Perpustakaan
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Jelajahi koleksi buku yang tersedia dan lihat detail atau ajukan peminjaman.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3 shrink-0">
            @can('kelola-buku')
                <a href="{{ route('buku.kelola') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-sm font-bold transition">
                    Kelola Data
                </a>
                <a href="{{ route('buku.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Buku</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Filter Pencarian & Kategori -->
    <form method="GET" action="{{ route('buku.index') }}" class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-sm grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
        <div class="md:col-span-6">
            <label for="cari" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                Cari Judul atau Penulis
            </label>
            <input type="text" id="cari" name="cari" value="{{ request('cari') }}"
                   placeholder="Ketik judul buku atau nama penulis..."
                   class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
        </div>

        <div class="md:col-span-4">
            <label for="kategori_id" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                Kategori
            </label>
            <select id="kategori_id" name="kategori_id"
                    class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-2 flex items-center gap-2">
            <button type="submit"
                    class="w-full px-4 py-2.5 rounded-xl bg-[#06215c] hover:bg-emerald-600 text-white text-sm font-bold transition cursor-pointer">
                Cari
            </button>
            @if(request()->filled('cari') || request()->filled('kategori_id'))
                <a href="{{ route('buku.index') }}"
                   class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Grid Card Katalog Buku -->
    @if($buku->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($buku as $item)
                <div class="group bg-white rounded-2xl border border-slate-200 hover:border-emerald-500 p-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-[#06215c]/10 text-[#06215c] border border-[#06215c]/15">
                                {{ $item->kategori->nama ?? 'Umum' }}
                            </span>
                            <span class="text-xs font-bold text-slate-500">
                                {{ $item->tahun_terbit ?? '-' }}
                            </span>
                        </div>

                        <h2 class="text-lg font-extrabold text-slate-900 group-hover:text-[#06215c] transition leading-snug">
                            {{ $item->judul }}
                        </h2>

                        <p class="text-sm text-slate-600 mt-1.5">
                            Penulis: <span class="font-semibold text-slate-800">{{ $item->penulis }}</span>
                        </p>
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <a href="{{ route('buku.show', $item->id) }}"
                           class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl bg-[#06215c]/10 hover:bg-[#06215c] text-[#06215c] hover:text-white text-xs font-bold transition">
                            Detail Buku
                        </a>

                        <div class="flex items-center gap-2">
                            @can('Mengajukan peminjaman buku')
                                <a href="{{ route('peminjaman.create', ['buku_id' => $item->id]) }}"
                                   class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition">
                                    Pinjam
                                </a>
                            @endcan

                            @can('kelola-buku')
                                <a href="{{ route('buku.edit', $item->id) }}"
                                   class="inline-flex items-center justify-center px-3 py-2 rounded-xl border border-slate-300 hover:border-[#06215c] text-slate-700 hover:text-[#06215c] text-xs font-bold transition">
                                    Ubah
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center shadow-sm">
            <p class="text-base font-bold text-slate-800">Belum ada buku yang ditemukan</p>
            <p class="text-sm text-slate-500 mt-1">Coba ubah kata kunci pencarian atau filter kategori.</p>
        </div>
    @endif
</div>
@endsection