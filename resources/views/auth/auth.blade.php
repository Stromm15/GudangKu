<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GudangKu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#ff842c] font-[Poppins] flex items-center justify-center p-4 sm:p-6">

    {{-- ================= ALERT ================= --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('login_error'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: @json(session('login_error')),
                confirmButtonColor: '#ff842c'
            });
        });
    </script>
    @endif

    @if(session('register_success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: 'Silakan login.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ff842c'
            }).then(() => {
                window.location = '{{ route('login') }}';
            });
        });
    </script>
    @endif


    {{-- ================= MAIN CARD ================= --}}

    <main
        class="w-full max-w-[1050px] min-h-[600px]
        bg-white rounded-3xl overflow-hidden
        shadow-[0_25px_70px_rgba(0,0,0,.18)]
        flex flex-col md:flex-row"
    >

        {{-- ================= LEFT BRANDING ================= --}}

        <section
            class="relative md:w-[43%]
            bg-[#555555]
            text-white
            flex flex-col justify-between
            p-7 sm:p-10 md:p-12
            overflow-hidden"
        >

            {{-- Decorative --}}
            <div class="absolute -right-20 -top-20 w-56 h-56 rounded-full bg-[#ff842c]/20"></div>

            <div class="absolute -left-24 -bottom-24 w-64 h-64 rounded-full bg-black/10"></div>


            {{-- Logo --}}

            <div class="relative z-10">

                <div class="flex items-center gap-3">

                    <div
                        class="w-11 h-11 rounded-xl
                        bg-[#ff842c]
                        flex items-center justify-center
                        shadow-lg"
                    >
                        <i class="bx bx-package text-2xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-2xl font-semibold leading-none">
                            <span class="text-[#ff842c]">Gudang</span>Ku
                        </h1>

                        <p class="text-[10px] text-white/50 tracking-[.2em] uppercase mt-1">
                            Inventory System
                        </p>
                    </div>

                </div>

            </div>


            {{-- Text --}}

            <div class="relative z-10 my-10 md:my-0">

                <p class="text-[#ff842c] text-xs uppercase tracking-[.2em] font-medium mb-4">
                    Manage your inventory
                </p>

                <h2 class="text-3xl sm:text-4xl font-semibold leading-tight">
                    Kelola gudang
                    <span class="text-[#ff842c]">lebih mudah.</span>
                </h2>

                <p class="text-sm text-white/60 leading-7 mt-5 max-w-sm">
                    GudangKu membantu Anda mengatur, memantau,
                    dan mengelola persediaan barang dengan lebih
                    praktis dan terorganisir.
                </p>

            </div>


            {{-- Footer --}}

            <div class="relative z-10">

                <div class="h-px bg-white/10 mb-4"></div>

                <p class="text-xs text-white/40">
                    © {{ date('Y') }} GudangKu
                </p>

            </div>

        </section>


        {{-- ================= RIGHT FORM ================= --}}

        <section
            class="md:w-[57%]
            flex items-center justify-center
            p-6 sm:p-10 md:p-14"
        >

            <div class="w-full max-w-[390px]">


                {{-- ================= LOGIN ================= --}}

                <div id="loginForm">

                    <div class="mb-8">

                        <h2 class="text-3xl font-semibold text-[#292929] mt-2">
                            Selamat datang 
                        </h2>

                        <p class="text-sm text-gray-500 mt-2">
                            Masuk ke akun GudangKu Anda.
                        </p>

                    </div>


                    <form action="/login" method="POST">

                        @csrf


                        {{-- USERNAME --}}

                        <div class="mb-5">

                            <label
                                for="username"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Username
                            </label>

                            <div class="relative">

                                <i
                                    class="bx bx-user absolute left-4 top-1/2
                                    -translate-y-1/2 text-gray-400 text-xl"
                                ></i>

                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    autocomplete="username"
                                    required
                                    placeholder="Masukkan username"
                                    class="w-full h-12
                                    rounded-xl
                                    border border-gray-200
                                    bg-gray-50
                                    pl-12 pr-4
                                    text-sm
                                    outline-none
                                    transition
                                    focus:border-[#ff842c]
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-orange-100"
                                >

                            </div>

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-6">

                            <div class="flex items-center justify-between mb-2">

                                <label
                                    for="loginPassword"
                                    class="text-sm font-medium text-gray-700"
                                >
                                    Password
                                </label>

                            </div>

                            <div class="relative">

                                <i
                                    class="bx bx-lock-alt absolute left-4 top-1/2
                                    -translate-y-1/2 text-gray-400 text-xl"
                                ></i>

                                <input
                                    type="password"
                                    id="loginPassword"
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                    placeholder="Masukkan password"
                                    class="w-full h-12
                                    rounded-xl
                                    border border-gray-200
                                    bg-gray-50
                                    pl-12 pr-12
                                    text-sm
                                    outline-none
                                    transition
                                    focus:border-[#ff842c]
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-orange-100"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('loginPassword','loginToggleIcon')"
                                    class="absolute right-4 top-1/2
                                    -translate-y-1/2
                                    text-gray-400
                                    hover:text-[#ff842c]"
                                >
                                    <i
                                        id="loginToggleIcon"
                                        class="bx bx-show text-xl"
                                    ></i>
                                </button>

                            </div>

                        </div>


                        {{-- LOGIN BUTTON --}}

                        <button
                            type="submit"
                            class="w-full h-12
                            rounded-xl
                            bg-[#ff842c]
                            hover:bg-[#e87524]
                            text-white
                            font-medium
                            text-sm
                            flex items-center justify-center gap-2
                            transition
                            shadow-lg shadow-orange-200"
                        >

                            Login

                            <i class="bx bx-right-arrow-alt text-xl"></i>

                        </button>

                    </form>


                    {{-- REGISTER LINK --}}

                    <div class="text-center mt-7">

                        <p class="text-sm text-gray-500">

                            Belum punya akun?

                            <button
                                type="button"
                                onclick="showRegister()"
                                class="text-[#ff842c] font-semibold hover:underline ml-1"
                            >
                                Register
                            </button>

                        </p>

                    </div>

                </div>


                {{-- ================= REGISTER ================= --}}

                <div id="registerForm" class="hidden">

                    <div class="mb-8">

                        <p class="text-[#ff842c] text-xs font-medium uppercase tracking-[.18em]">
                            Create account
                        </p>

                        <h2 class="text-3xl font-semibold text-[#292929] mt-2">
                            Buat akun
                        </h2>

                        <p class="text-sm text-gray-500 mt-2">
                            Daftarkan akun baru untuk menggunakan GudangKu.
                        </p>

                    </div>


                    @if($errors->any())

                        <div class="bg-red-50 border border-red-100 text-red-600 rounded-xl p-3 mb-5 text-sm">

                            @foreach($errors->all() as $error)

                                <p>{{ $error }}</p>

                            @endforeach

                        </div>

                    @endif


                    <form action="/register" method="POST">

                        @csrf


                        {{-- USERNAME --}}

                        <div class="mb-5">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Username
                            </label>

                            <div class="relative">

                                <i class="bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>

                                <input
                                    type="text"
                                    name="username"
                                    autocomplete="off"
                                    required
                                    placeholder="Buat username"
                                    class="w-full h-12 rounded-xl
                                    border border-gray-200
                                    bg-gray-50
                                    pl-12 pr-4
                                    text-sm outline-none
                                    transition
                                    focus:border-[#ff842c]
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-orange-100"
                                >

                            </div>

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-6">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>

                            <div class="relative">

                                <i class="bx bx-lock-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="registerPassword"
                                    autocomplete="new-password"
                                    required
                                    placeholder="Buat password"
                                    class="w-full h-12 rounded-xl
                                    border border-gray-200
                                    bg-gray-50
                                    pl-12 pr-12
                                    text-sm outline-none
                                    transition
                                    focus:border-[#ff842c]
                                    focus:bg-white
                                    focus:ring-4
                                    focus:ring-orange-100"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('registerPassword','registerToggleIcon')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#ff842c]"
                                >

                                    <i
                                        id="registerToggleIcon"
                                        class="bx bx-show text-xl"
                                    ></i>

                                </button>

                            </div>

                        </div>


                        {{-- REGISTER BUTTON --}}

                        <button
                            type="submit"
                            class="w-full h-12 rounded-xl
                            bg-[#ff842c]
                            hover:bg-[#e87524]
                            text-white
                            font-medium text-sm
                            flex items-center justify-center gap-2
                            transition
                            shadow-lg shadow-orange-200"
                        >

                            Register

                            <i class="bx bx-user-plus text-xl"></i>

                        </button>

                    </form>


                    {{-- LOGIN LINK --}}

                    <div class="text-center mt-7">

                        <p class="text-sm text-gray-500">

                            Sudah punya akun?

                            <button
                                type="button"
                                onclick="showLogin()"
                                class="text-[#ff842c] font-semibold hover:underline ml-1"
                            >
                                Login
                            </button>

                        </p>

                    </div>

                </div>

            </div>

        </section>

    </main>


    {{-- ================= JAVASCRIPT ================= --}}

    <script>

        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {

                input.type = "text";

                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");

            } else {

                input.type = "password";

                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");

            }

        }


        function showRegister() {

            const login = document.getElementById('loginForm');
            const register = document.getElementById('registerForm');

            login.classList.add('hidden');
            register.classList.remove('hidden');

        }


        function showLogin() {

            const login = document.getElementById('loginForm');
            const register = document.getElementById('registerForm');

            register.classList.add('hidden');
            login.classList.remove('hidden');

        }

    </script>

</body>
</html>
