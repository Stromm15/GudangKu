<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GudangKu..')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans bg-[#f5f6f8] text-[#292929]">

    <input type="checkbox" id="check" class="hidden peer">

    <label for="check"
        class="hidden peer-checked:block md:!hidden fixed inset-0 bg-black/50 z-[999]"></label>

    {{-- Mobile topbar --}}
    <header class="md:hidden sticky top-0 z-[1050] flex items-center justify-between bg-sidebar-dark text-white px-4 py-3 shadow-lg">
        <div>
            <p class="text-[10px] uppercase tracking-[.18em] text-white/50">Inventory System</p>
            <h3 class="text-lg font-semibold leading-tight">
                <span class="text-brand">Gudang</span>Ku<span class="text-white/60">.</span>
            </h3>
        </div>

        <label for="check" class="cursor-pointer w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
            <i class="bx bx-menu text-2xl"></i>
        </label>
    </header>

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="fixed -left-[270px] md:left-0 top-0 w-[270px] h-full bg-sidebar-dark transition-all duration-300 z-[1000] shadow-2xl md:shadow-none overflow-y-auto">

        <div class="h-[82px] px-6 flex items-center border-b border-white/10">
            <div>
                <p class="text-[10px] uppercase tracking-[.2em] text-white/40">Inventory System</p>
                <h3 class="text-2xl font-semibold text-white">
                    <span class="text-brand">Gudang</span>Ku<span class="text-white/50">.</span>
                </h3>
            </div>
        </div>

        <div class="px-4 pt-6">
            <p class="px-3 mb-2 text-[10px] uppercase tracking-[.16em] text-white/35">Menu utama</p>

            <nav class="space-y-1.5">
                <a href="{{ route('dashboard') }}"
                   class="group flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                   {{ request()->routeIs('dashboard') ? 'bg-brand text-white shadow-lg shadow-orange-950/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="bx bxs-dashboard text-xl {{ request()->routeIs('dashboard') ? '' : 'text-white/50 group-hover:text-brand' }}"></i>
                    Dashboard
                </a>

                <a href="{{ route('barang.index') }}"
                   class="group flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                   {{ request()->routeIs('barang.*') ? 'bg-brand text-white shadow-lg shadow-orange-950/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="bx bx-package text-xl {{ request()->routeIs('barang.*') ? '' : 'text-white/50 group-hover:text-brand' }}"></i>
                    Barang
                </a>
            </nav>

            <p class="px-3 mt-8 mb-2 text-[10px] uppercase tracking-[.16em] text-white/35">Akun</p>

            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" onclick="konfirmasiLogout()"
                    class="group flex items-center gap-3 w-full px-3 py-3 rounded-xl text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition">
                    <i class="bx bxs-log-out text-xl text-white/50 group-hover:text-brand"></i>
                    Logout
                </button>
            </form>
        </div>

        <div class="absolute bottom-0 left-0 right-0 p-5 hidden md:block">
            <div class="rounded-xl bg-white/5 border border-white/10 p-4">
                <p class="text-xs text-white/40">GudangKu</p>
                <p class="text-xs text-white/60 mt-1">Keep it simple, keep it organized.</p>
            </div>
        </div>
    </aside>

    {{-- Content --}}
    <main id="content" class="md:ml-[270px] min-h-screen transition-all duration-300">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
