<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - GudangKu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>
<body class="font-sans bg-gray-50">

    <nav class="flex items-center justify-between bg-sidebar text-white px-8 py-4">
        <h2 class="text-2xl">Gudang<span class="text-brand">Ku...</span></h2>
        <a href="{{ route('login') }}" class="hover:underline">Kembali</a>
    </nav>

    <div class="max-w-3xl mx-auto px-6 py-12">
        <h3 class="text-2xl font-semibold mb-4">Ini Web Apaan Sih?</h3>
        <p class="text-gray-700 leading-relaxed">
            Jadi ini teh web management stock buatan seorang pelajar yang bernama "ezar". Di web ini teh kalian bisa ngatur barang-barang yang ada di gudang atau toko biar lebih rapi, gampang di lacak, dan ga ribet soalnya kalian jadi ga butuh kertas catatan lagi...
        </p>

        <p class="text-gray-700 mt-6 mb-2">Biar lebih jelas, nih ada kegunaan web ini:</p>
        <ol class="list-decimal list-inside text-gray-700 space-y-1">
            <li>Cek stock kapan saja (selama terkoneksi internet)</li>
            <li>Pencatatan stock barang terlihat lebih rapi dan teratur</li>
            <li>Menghemat waktu</li>
        </ol>
    </div>

</body>
</html>
