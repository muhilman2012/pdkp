<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('/assets/logo/logo-sekwapres.svg')}}" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" type="text/css" />

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
                        success: '#4CB963',
                        danger: '#F80000',
                        red: '#880D1E',
                        purple: '#B98EA7',
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Layanan - PDKP - Pelayanan Dukungan Kendaraan & Pengemudi</title>
</head>

<body>
    <section
        class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ url ('/assets/logo/logo-sekwapres.svg') }}" alt="logo sekwapres">
            <img class="w-4/12 h-fit" src="{{ url ('/assets/logo/logo-pdkp-gold.png') }}" alt="logo pdkp">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <a href="{{ route ('pages.dashboard') }}">
                <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            </a>
            <p class="font-bold text-lg leading-5 w-full">Pilih Dukungan Layanan</p>
        </div>

        <img class="h-50 rounded-lg mt-6" src="{{ url ('/assets/images/gedung.png') }}" alt="foto gedung" srcset="foto gedung   ">
        <div class="flex flex-col mt-10 gap-3">
            <p class="text-sm leading-5 w-full">
                Silahkan pilih dukungan layanan dengan mengklik menu di bawah ini.
            </p>
            <div class="flex flex-col gap-4">
                @if(Auth::user()->unit_kerja == 11)
                    <div class="flex justify-between gap-4 text-white">
                        <a href="{{ route('layanan.wapres') }}" class="flex flex-col justify-between items-end bg-gold w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="star" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">WAPRES</span></p>
                        </a>
                        <a href="{{ route('layanan.tamu') }}" class="flex flex-col justify-start items-end bg-silver w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="man" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">TAMU NEGARA</span></p>
                        </a>
                    </div>
                    <div class="flex justify-between gap-4 text-white">
                        <a href="{{ route('layanan.eselon') }}" class="flex flex-col justify-start items-end bg-red w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="id-card" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">ESELON</span></p>
                        </a>
                        <a href="{{ route('layanan.pegawai') }}" class="flex flex-col justify-start items-end bg-purple w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="bag-sharp" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">PEGAWAI</span></p>
                        </a>
                    </div>
                @else
                    <div class="flex justify-between gap-4 text-white">
                        <a href="{{ route('layanan.eselon') }}" class="flex flex-col justify-start items-end bg-red w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="id-card" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">ESELON</span></p>
                        </a>
                        <a href="{{ route('layanan.pegawai') }}" class="flex flex-col justify-start items-end bg-purple w-full gap-3 p-3 rounded-lg">
                            <ion-icon name="bag-sharp" class="w-6 h-6"></ion-icon>
                            <p class="font-medium text-sm text-left w-full">Dukungan Layanan Untuk <span class="font-bold">PEGAWAI</span></p>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</body>

</html>