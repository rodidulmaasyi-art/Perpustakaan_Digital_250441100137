@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-2xl border border-slate-200 border-t-4 border-t-[#06215c] shadow-sm overflow-hidden">
        <!-- Header Form -->
        <div class="px-6 py-5 bg-slate-50/70 border-b border-slate-200 flex items-center justify-between gap-4">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">
                    Registrasi Koleksi Baru
                </span>
                <h1 class="text-xl font-extrabold text-[#06215c] mt-0.5">
                    Tambah Buku Baru
                </h1>
            </div>
            <a href="{{ route('buku.index') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold transition">
                &larr; Kembali ke Katalog
            </a>
        </div>

        <!-- Isi Form -->
        <form action="{{ route('buku.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="kategori_id" class="block text-sm font-bold text-slate-700 mb-1.5">
                        Kategori Buku
                    </label>
                    <select name="kategori_id" id="kategori_id" required
                            class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tahun_terbit" class="block text-sm font-bold text-slate-700 mb-1.5">
                        Tahun Terbit
                    </label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" min="1900" max="2030"
                           value="{{ old('tahun_terbit') }}" placeholder="Contoh: 2024" required
                           class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
                    @error('tahun_terbit')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="judul" class="block text-sm font-bold text-slate-700 mb-1.5">
                        Judul Buku
                    </label>
                    <input type="text" name="judul" id="judul"
                           value="{{ old('judul') }}" placeholder="Masukkan judul buku" required
                           class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
                    @error('judul')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="penulis" class="block text-sm font-bold text-slate-700 mb-1.5">
                        Penulis
                    </label>
                    <input type="text" name="penulis" id="penulis"
                           value="{{ old('penulis') }}" placeholder="Nama penulis" required
                           class="w-full rounded-xl border-slate-300 bg-slate-50 focus:bg-white focus:border-[#06215c] focus:ring-emerald-500 text-sm text-slate-900">
                    @error('penulis')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('buku.index') }}"
                   class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-[#06215c] hover:bg-emerald-600 text-white text-sm font-bold shadow-sm transition">
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</div>
@endsection