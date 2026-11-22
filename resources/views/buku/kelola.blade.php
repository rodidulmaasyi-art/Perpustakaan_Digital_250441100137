@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/buku.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="buku-container">
    <!-- Header Kelola Buku -->
    <div class="bg-white rounded-2xl border border-slate-200 border-t-4 border-t-[#06215c] p-5 sm:p-6 shadow-sm mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                Manajemen Koleksi · 250441100137
            </div>
            <h2 class="text-2xl font-extrabold text-[#06215c] tracking-tight m-0">
                Pengelolaan Data Buku
            </h2>
            <p class="text-sm text-slate-600 mt-1 m-0">
                Kelola, perbarui, dan hapus data buku perpustakaan.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3 shrink-0">
            <a href="{{ route('buku.index') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-sm font-bold transition no-underline">
                &larr; Lihat Katalog
            </a>

            @can('kelola-buku')
                <a href="{{ route('buku.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-sm transition no-underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Buku</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Tabel Daftar Buku -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="buku-table-body">
                @forelse($buku as $item)
                    <tr>
                        <td>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-[#06215c]/10 text-[#06215c] border border-[#06215c]/15">
                                {{ $item->kategori->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="font-bold text-slate-900">{{ $item->judul }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->tahun_terbit }}</td>
                        <td>
                            @can('kelola-buku')
                                <a href="{{ route('buku.edit', $item->id) }}" class="btn-ubah">Ubah</a>
                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            @else
                                <a href="{{ route('buku.show', $item->id) }}" class="btn-detail">Detail</a>
                                @can('Mengajukan peminjaman buku')
                                    <a href="{{ route('peminjaman.create', ['buku_id' => $item->id]) }}" class="btn-pinjam">Pinjam</a>
                                @endcan
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="baris-info">Belum ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection