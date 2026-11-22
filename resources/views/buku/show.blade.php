@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-4">
        <a href="{{ route('buku.index') }}" class="text-sm text-[#06215c] hover:text-emerald-700 font-bold inline-flex items-center gap-1 transition">
            &larr; Kembali ke Katalog Buku
        </a>
    </div>

    @if ($buku)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-[#06215c] p-6 sm:p-8">
            <div class="flex items-center justify-between gap-3 mb-4">
                <span class="px-3 py-1 bg-[#06215c]/10 text-[#06215c] border border-[#06215c]/15 text-xs font-bold rounded-full">
                    {{ is_object($buku->kategori) ? $buku->kategori->nama : ($buku['kategori'] ?? 'Umum') }}
                </span>
                <span class="text-xs font-semibold text-slate-400">ID Buku: #{{ $buku->id ?? $buku['id'] }}</span>
            </div>

            <h1 class="text-2xl font-extrabold text-slate-900 mb-2 leading-tight">
                {{ $buku->judul ?? $buku['judul'] }}
            </h1>

            <div class="border-t border-b border-slate-100 py-4 my-5 space-y-3 text-sm text-slate-600">
                <div class="flex items-center justify-between gap-4">
                    <span class="font-medium text-slate-500">Penulis / Pengarang:</span>
                    <span class="font-bold text-slate-900 text-right">{{ $buku->penulis ?? $buku['penulis'] }}</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="font-medium text-slate-500">Tahun Terbit:</span>
                    <span class="font-bold text-slate-900">{{ $buku->tahun_terbit ?? $buku['tahun'] ?? '-' }}</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="font-medium text-slate-500">Status Ketersediaan:</span>
                    <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full text-xs">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                        Tersedia di Perpustakaan
                    </span>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                @can('Mengajukan peminjaman buku')
                    <a href="{{ route('peminjaman.create', ['buku_id' => $buku->id ?? $buku['id']]) }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Ajukan Peminjaman Buku Ini
                    </a>
                @endcan

                @can('Kelola data buku')
                    <a href="{{ route('buku.kelola') }}" class="inline-flex items-center px-4 py-2.5 bg-[#06215c]/10 text-[#06215c] hover:bg-[#06215c]/15 text-sm font-bold rounded-xl transition">
                        Kelola di Inventaris &rarr;
                    </a>
                @endcan
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-red-600 p-8 text-center">
            <h2 class="text-xl font-extrabold text-red-600 mb-2">Buku Tidak Ditemukan</h2>
            <p class="text-slate-500 mb-5 text-sm">Maaf, buku yang Anda cari tidak tersedia dalam database kami.</p>
            <a href="{{ route('buku.index') }}" class="inline-flex items-center px-4 py-2.5 bg-[#06215c] hover:bg-emerald-600 text-white text-sm font-bold rounded-xl transition">
                Kembali ke Katalog
            </a>
        </div>
    @endif
</div>
@endsection