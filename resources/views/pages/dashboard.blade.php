<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('/assets/logo/logo-sekwapres.svg')}}" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

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
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Dashboard - PDKP - Pelayanan Dukungan Kendaraan & Pengemudi</title>
</head>

<body>
    <section class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ url ('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
            <img class="w-4/12 h-fit" src="{{ url ('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
        </div>
        <div class="flex justify-between items-center mt-5">
            <div class="flex flex-col">
                <p class="font-medium text-regular">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p id="greeting" class="font-bold text-xl"></p>
            </div>
            <a href="{{ route('logout') }}">
                <ion-icon name="exit" class="w-8 h-8 text-danger"></ion-icon>
            </a>
        </div>
        <div class="flex justify-between gap-4 text-white mt-5">
            <a href="{{ route('pages.layanan') }}" class="flex flex-col justify-between items-end bg-gold w-full gap-3 p-3 rounded-lg">
                <ion-icon name="git-pull-request-outline" class="w-6 h-6"></ion-icon>
                <p class="font-medium text-sm text-left w-full">Permintaan Layanan Dukungan</p>
            </a>
            <a href="{{ route('pages.profile') }}" class="flex flex-col justify-start items-end bg-silver w-full gap-3 p-3 rounded-lg">
                <ion-icon name="person-circle" class="w-6 h-6"></ion-icon>
                <p class="font-medium text-sm text-left w-full">Profil<br /> Pengguna</p>
            </a>
        </div>

        <div class="text-black flex flex-col mt-5">
            <h4 class="font-semibold text-regular mb-3">Info Update Layanan</h4>
            <div class="flex flex-col gap-4 w-full">
                @foreach($permintaan as $item)
                    @if($item->layanan == 'wapres')
                        <a href="" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
                            <ion-icon name="star" class="text-gold h-6 w-6"></ion-icon>
                            <div class="flex flex-col w-full gap-2">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-xs ">{{ $item->tujuan_akhir }}</p>
                                        <p class="text-xs ">{{ $item->jam_awal }}</p>
                                    </div>
                                    <div class="bg-gold py-1 px-2 rounded text-white">
                                        <p class="font-bold text-xs">WAPRES</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                                <div class="flex justify-between items-center italic text-black text-xs">
                                    <p>{{ $item->kendaraan }} , {{ $item->pengemudi }}</p>
                                    <p>oleh {{ $item->pengguna }}</p>
                                </div>
                            </div>
                        </a>
                    @elseif($item->layanan == 'tamu')
                        <a href="" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
                            <ion-icon name="man" class="w-6 h-6 text-green"></ion-icon>
                            <div class="flex flex-col w-full gap-2">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-xs ">{{ $item->tujuan_akhir }}</p>
                                        <p class="text-xs ">{{ $item->jam_awal }}</p>
                                    </div>
                                    <div class="bg-green py-1 px-2 rounded text-white">
                                        <p class="font-bold text-xs">TAMU</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                                <div class="flex justify-between items-center italic text-black text-xs">
                                    <p>{{ $item->kendaraan }} , {{ $item->pengemudi }}</p>
                                    <p>oleh {{ $item->pengguna }}</p>
                                </div>
                            </div>
                        </a>
                    @elseif($item->layanan == 'eselon')
                        <a href="" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
                            <ion-icon name="id-card" class="w-6 h-6 text-red"></ion-icon>
                            <div class="flex flex-col w-full gap-2">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-xs ">{{ $item->tujuan_akhir }}</p>
                                        <p class="text-xs ">{{ $item->jam_awal }}</p>
                                    </div>
                                    <div class="bg-red py-1 px-2 rounded text-white">
                                        <p class="font-bold text-xs">ESELON</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                                <div class="flex justify-between items-center italic text-black text-xs">
                                    <p>{{ $item->kendaraan }} , {{ $item->pengemudi }}</p>
                                    <p>oleh {{ $item->pengguna }}</p>
                                </div>
                            </div>
                        </a>
                    @elseif($item->layanan == 'pegawai')
                        <a href="" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
                            <ion-icon name="bag-sharp" class="w-6 h-6 text-purple"></ion-icon>
                            <div class="flex flex-col w-full gap-2">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-xs ">{{ $item->tujuan_akhir }}</p>
                                        <p class="text-xs ">{{ $item->jam_awal }}</p>
                                    </div>
                                    <div class="bg-green py-1 px-2 rounded text-white">
                                        <p class="font-bold text-xs">{{ $item->status }}</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                                <div class="flex justify-between items-center italic text-black text-xs">
                                    <p>{{ $item->kendaraan }} , {{ $item->pengemudi }}</p>
                                    <p>oleh {{ $item->pengguna }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const greetingElement = document.getElementById('greeting');
            const currentHour = new Date().getHours();
            let greetingMessage = '';

            if (currentHour >= 5 && currentHour < 12) {
                greetingMessage = 'Selamat Pagi';
            } else if (currentHour >= 12 && currentHour < 18) {
                greetingMessage = 'Selamat Siang';
            } else if (currentHour >= 18 && currentHour < 21) {
                greetingMessage = 'Selamat Sore';
            } else {
                greetingMessage = 'Selamat Malam';
            }

            // Dapatkan nama pengguna dari server-side
            const userName = @json(auth('web')->user()->name);

            // Gabungkan ucapan dengan nama pengguna
            greetingElement.innerHTML = `${greetingMessage}, ${userName}`;
        });
    </script>
    <script src="{{ url('/assets/app/js/app.js') }}"></script>
    <script src="{{ url('/assets/dist/js/alert.js') }}"></script>
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session()->get("success") }}',
        })
    </script>
    @elseif(session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Maaf',
            text: '{{ session()->get("error") }}',
        })
    </script>
    @endif
</body>

</html>