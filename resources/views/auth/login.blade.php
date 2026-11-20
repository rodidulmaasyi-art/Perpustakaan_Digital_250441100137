<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-5xl mx-auto overflow-hidden rounded-2xl bg-white shadow-[0_20px_60px_-15px_rgba(6,33,92,0.22)] border border-slate-200 grid grid-cols-1 lg:grid-cols-12">
        <!-- Banner Sisi Kiri Gaya Portal Resmi -->
        <div class="lg:col-span-6 relative bg-gradient-to-br from-[#06215c] via-[#0b3285] to-[#04153b] p-8 sm:p-10 text-white flex flex-col justify-between overflow-hidden">
            <!-- Dekorasi Garis & Cahaya -->
            <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute -left-20 -bottom-20 h-72 w-72 rounded-full bg-sky-400/15 blur-2xl"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 rounded-md bg-emerald-500/20 border border-emerald-400/40 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-emerald-300">
                    Portal Resmi Anggota &amp; Pustakawan
                </div>

                <p class="mt-6 text-xs font-bold uppercase tracking-[0.2em] text-amber-300">
                    Perpustakaan Hadir untuk Literasi
                </p>
                <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold uppercase tracking-tight leading-tight text-white">
                    Perpustakaan Digital
                    <span class="block text-emerald-400 mt-1">250441100137</span>
                </h1>

                <p class="mt-4 text-sm leading-relaxed text-blue-100/90">
                    Masuk untuk mengelola katalog buku, memproses peminjaman dan pengembalian, serta mengakses layanan digital dengan cepat dan terstruktur.
                </p>
            </div>

            <div class="relative z-10 mt-8 pt-5 border-t border-white/15 grid grid-cols-2 gap-4 text-xs">
                <div class="rounded-xl bg-white/10 px-3.5 py-2.5 backdrop-blur-xs">
                    <div class="font-bold text-emerald-300">Akses Cepat</div>
                    <div class="text-blue-100/80 mt-0.5">Katalog &amp; Riwayat Pinjam</div>
                </div>
                <div class="rounded-xl bg-white/10 px-3.5 py-2.5 backdrop-blur-xs">
                    <div class="font-bold text-amber-300">Identitas Mahasiswa</div>
                    <div class="text-blue-100/80 mt-0.5">NIM 250441100137</div>
                </div>
            </div>
        </div>

        <!-- Form Login Sisi Kanan -->
        <div class="lg:col-span-6 p-8 sm:p-10 flex flex-col justify-center bg-white">
            <div class="mb-6 pb-4 border-b border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-[#06215c]">
                    Autentikasi Sistem
                </span>
                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                    Masuk ke Akun
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Gunakan email dan password terdaftar untuk masuk.
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700">
                        {{ __('Email') }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="nama@email.com"
                        class="mt-1.5 block w-full rounded-lg border border-slate-300 bg-slate-50/60 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 transition focus:border-[#06215c] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#06215c]/15"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700">
                        {{ __('Password') }}
                    </label>
                    <div class="relative mt-1.5">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••••••"
                            class="block w-full rounded-lg border border-slate-300 bg-slate-50/60 py-2.5 pl-3.5 pr-11 text-sm text-slate-900 placeholder-slate-400 transition focus:border-[#06215c] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#06215c]/15"
                        />
                        <button
                            type="button"
                            onclick="togglePasswordVisibility()"
                            aria-label="Tampilkan atau sembunyikan password"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-[#06215c] focus:outline-none"
                        >
                            <svg id="eye-icon-open" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="eye-icon-closed" class="hidden h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between gap-2 pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 rounded border-slate-300 text-[#06215c] focus:ring-[#06215c]"
                        />
                        <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-semibold text-[#06215c] hover:text-emerald-700 transition"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center rounded-lg bg-[#06215c] px-4 py-3 text-sm font-bold tracking-wide text-white shadow-sm transition hover:bg-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 cursor-pointer"
                    >
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('password');
            const openIcon = document.getElementById('eye-icon-open');
            const closedIcon = document.getElementById('eye-icon-closed');

            if (input.type === 'password') {
                input.type = 'text';
                openIcon.classList.add('hidden');
                closedIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                openIcon.classList.remove('hidden');
                closedIcon.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>