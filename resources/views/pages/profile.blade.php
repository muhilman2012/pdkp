<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{asset('/assets/logo/logo-sekwapres.svg')}}" type="image/svg">
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
                        silver: '#505050',
                        green: '#00A6A6',
                        red: '#880D1E',
                        danger: '#F80000',
                        purple: '#B98EA7',
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Profile - User PDKP</title>
</head>

<body>
    <section class="flex flex-col justify-between px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-full text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex flex-col">
            <div class="flex justify-between">
                <img class="w-12" src="{{ url ('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
                <img class="w-4/12 h-12" src="{{ url ('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
            </div>
            <div class="flex mt-5 items-center justify-center gap-2 w-full">
                <a href="{{ route ('pages.dashboard') }}">
                    <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
                </a>
                <p class="font-bold text-lg leading-5 w-full">Profile Pegawai</p>
            </div>
            <div class="flex flex-col mt-5 items-center justify-center gap-4">
                @if($user->foto)
                    <img class="h-20 w-20 rounded-full" src="{{ asset('/images/users/' . $user->foto) }}" alt="Foto Profil {{ $user->name }}">
                @else
                    <img class="h-20 w-20 rounded-full" src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="Avatar Default">
                @endif
                <div class="flex flex-col gap-0 items-center">
                    <p class="text-xl font-semibold">{{ $user->name }}</p>
                    <p class="text-silver">{{ $user->jabatan }}</p>
                </div>
            </div>
            <div class="flex flex-col mt-4 gap-4">
                <div class="flex flex-col w-full gap-1">
                    <label for="name" class="text-black font-medium text-[14px]">Nama</label>
                    <input id="name" name="name" type="text" value="{{ $user->name }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" disabled>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="nip" class="text-black font-medium text-[14px]">NIP</label>
                    <input id="nip" name="nip" type="text" value="{{ $user->nip }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" disabled>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="email" class="text-black font-medium text-[14px]">Email</label>
                    <input id="email" name="email" type="text" value="{{ $user->email }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" disabled>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="phone" class="text-black font-medium text-[14px]">No. HP / Whatsapp</label>
                    <input id="phone" name="phone" type="text" value="{{ $user->phone }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" disabled>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="unit_kerja" class="text-black font-medium text-[14px]">Unit Kerja</label>
                    <input id="unit_kerja" name="unit_kerja" type="text" value="{{ $user->divisi->nama }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" disabled>
                </div>
            </div>
        </div>
        <div class="flex flex-col mt-4 gap-2 mb-4">
            <a href="{{ route('pages.history') }}" class="w-full rounded bg-transparent text-center text-gold font-semibold p-3 outline outline-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Histori Permintaan</a>
            <a href="{{ route('pages.editprofile') }}" class="w-full rounded bg-gold text-center text-white font-semibold p-3 hover:bg-[#B57F21] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Edit Profil</a>
            <a href="{{ route('logout.user') }}" onclick="event.preventDefault(); document.getElementById('logout-form-user').submit();" class="w-full rounded bg-danger text-center text-white font-semibold p-3 hover:bg-[#DE0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Keluar</a>
            <form id="logout-form-user" action="{{ route('logout.user') }}" method="POST" style="display: none;">
                @csrf
            </form>
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