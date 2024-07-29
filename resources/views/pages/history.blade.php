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
                        silver: '#505050',
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

    <title>Histori Permintaan - PDKP</title>
</head>

<body>
    <section class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="text-black flex flex-col mt-5">
            <div class="flex justify-between">
                <img class="w-12" src="{{ url ('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
                <img class="w-4/12 h-12" src="{{ url ('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
            </div>
            <div class="flex mt-5 items-center justify-center gap-2 w-full">
                <a href="{{ route ('pages.profile') }}">
                    <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
                </a>
                <p class="font-bold text-lg leading-5 w-full">History Permintaan</p>
            </div>
            <div class="flex flex-col gap-4 w-full">
                @foreach($permintaan as $item)
                    @php
                        $bgColor = '';
                        $statusText = $item->status; // Menyimpan status asli
                        if ($item->status == 'BARU') {
                            $bgColor = 'bg-warning';
                            $statusText = 'DIAJUKAN'; // Ubah teks yang ditampilkan
                        } elseif ($item->status == 'DIKONFIRMASI') {
                            $bgColor = 'bg-yellow';
                            $statusText = 'DIKONFIRMASI';
                        } elseif ($item->status == 'DALAM PERJALANAN') {
                            $bgColor = 'bg-blue';
                            $statusText = 'DALAM PERJALANAAN';
                        } elseif ($item->status == 'SELESAI') {
                            $bgColor = 'bg-success';
                            $statusText = 'SELESAI';
                        } elseif ($item->status == 'DIBATALKAN') {
                            $bgColor = 'bg-silver';
                            $statusText = 'DIBATALKAN';
                        }
                    @endphp
                    <a href="{{ route('pages.detail', ['id_permintaan' => $item->id_permintaan]) }}" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
                        <div x-data x-init="$nextTick(() => { document.querySelectorAll('ion-icon').forEach(icon => { const newIcon = document.createElement('ion-icon'); newIcon.setAttribute('name', icon.getAttribute('name')); newIcon.className = icon.className; icon.replaceWith(newIcon); }); })">
                            @if($item->layanan == 'Wapres')
                                <ion-icon name="star" class="text-gold h-6 w-6"></ion-icon>
                            @elseif($item->layanan == 'Tamu')
                                <ion-icon name="man" class="w-6 h-6 text-green"></ion-icon>
                            @elseif($item->layanan == 'Eselon')
                                <ion-icon name="id-card" class="w-6 h-6 text-red"></ion-icon>
                            @elseif($item->layanan == 'Pegawai')
                                <ion-icon name="bag-sharp" class="w-6 h-6 text-purple"></ion-icon>
                            @endif
                        </div>
                        <div class="flex flex-col w-full gap-2">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-1">
                                    <p class="text-xs">{{ $item->tujuan_akhir }}</p>
                                    <p class="text-xs">{{ $item->jam_awal }}</p>
                                </div>
                                <div class="{{ $bgColor }} py-1 px-2 rounded text-white">
                                    <p class="font-bold text-xs">{{ $statusText }}</p>
                                </div>
                            </div>
                            <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                            <div class="flex justify-between items-center italic text-black text-xs">
                                <p>
                                    @if($item->pengemudi)
                                        {{ $item->pengemudi->name }}
                                    @else
                                        belum dikonfirmasi
                                    @endif
                                    , {{ $item->kendaraan->name }}
                                </p>
                                <p>Lihat Detail -></p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
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