<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('/assets/logo/logo-sekwapres.svg') }}" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        :root {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
        }
    </style>

    <style>
        /* Menghilangkan panah pada input number di semua browser */
        .custom-number-input::-webkit-outer-spin-button,
        .custom-number-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#CB9638',
                        placeholder: '#D9D9D9',
                        quote: '#C8C8C8',
                        black: '#222A35',
                        gold: '#CB9638',
                        silver: '#8B8B8B',
                        green: '#00A6A6',
                        red: '#880D1E',
                        purple: '#B98EA7',
                        warning: '#FF0000',
                        yellow: '#FFCD00',
                        blue: '#008BFF',
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Detail Permintaan - PDKP</title>
</head>

<body>
    <section class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ url ('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
            <img class="w-4/12 h-fit" src="{{ url ('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <a href="{{ route('pengemudi.dashboard') }}">
                <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            </a>
            <p class="font-bold text-lg leading-5 w-full">Detail Permintaan</p>
        </div>
        <div class="flex flex-col gap-6 mt-6">
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Dukungan Layanan {{ $permintaan->layanan }}</p>
                <p class="font-normal text-sm leading-5">Deskripsi Keperluan : {{ $permintaan->keperluan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Penumpang</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->pengguna }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Permintaan</p>
                <div class="flex flex-col gap-0">
                    <div class="grid grid-cols-12">
                        <div class="col-span-5">
                            <p class="font-normal text-sm leading-5">Nama/Jenis Kendaraan</p>
                        </div>
                        <div class="col-span-1">:</div>
                        <div class="col-span-6">
                            <p class="font-semibold text-sm leading-5">{{ $permintaan->kendaraan }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-5">
                            <p class="font-normal text-sm text-left leading-5">Pengemudi</p>
                        </div>
                        <div class="col-span-1">:</div>
                        <div class="col-span-6">
                            <p class="font-semibold text-sm text-left leading-5">{{ $permintaan->pengemudi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Waktu dan Lokasi</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->tujuan_akhir }} , {{ $permintaan->jam_awal }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Progress Permintaan</p>
                <div class="flex gap-1">
                    @if($permintaan->status == 'BARU')
                        <div class="bg-warning py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">BARU</p>
                        </div>
                    @elseif($permintaan->status == 'DIKONFIRMASI')
                        <div class="bg-yellow py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">DIKONFIRMASI</p>
                        </div>
                    @elseif($permintaan->status == 'DALAM PERJALANAN')
                        <div class="bg-blue py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">SEDANG BERJALAN</p>
                        </div>
                    @elseif($permintaan->status == 'SELESAI')
                        <div class="bg-success py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">SELESAI</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</body>

</html>