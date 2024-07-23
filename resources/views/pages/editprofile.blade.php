<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ asset('/assets/logo/logo-sekwapres.svg') }}" type="image/svg">
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
                        danger: '#F80000',
                        purple: '#B98EA7',
                    }
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <title>Edit Profile - PDKP</title>
</head>

<body>
    <section
        class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ asset('/assets/logo/logo-sekwapres.svg') }}" alt="logo setwapres">
            <img class="w-4/12 h-fit" src="{{ asset('/assets/logo/logo-pdkp-gold.png') }}" alt="logo pdkp">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <a href="{{ route('pages.profile') }}">
                <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            </a>
            <p class="font-bold text-lg leading-5 w-full">Edit Profile</p>
        </div>
        <form action="{{ route('pages.profile.update') }}" method="POST">
            @csrf
            <div class="flex flex-col mt-4 gap-4">
                <div class="flex flex-col w-full gap-1">
                    <label for="name" class="text-black font-medium text-[14px]">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                    @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="nip" class="text-black font-medium text-[14px]">NIP</label>
                    <input id="nip" name="nip" type="text" value="{{ old('nip', $user->nip) }}"
                        class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold"
                        disabled readonly>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="email" class="text-black font-medium text-[14px]">Email</label>
                    <input id="email" name="email" type="text" value="{{ old('email', $user->email) }}"
                        class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                    @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="phone" class="text-black font-medium text-[14px]">No. HP / Whatsapp</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                    @error('phone')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="password" class="text-black font-medium text-[14px]">Password Baru</label>
                    <input id="password" name="password" type="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                    @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="password_confirmation" class="text-black font-medium text-[14px]">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan kembali password baru" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                </div>
            </div>
            <button type="submit" class="mt-4 w-full rounded bg-gold text-center text-white font-semibold p-3 hover:bg-[#B57F21] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Edit Profile</button>
        </form>
        <a href="{{ route('pages.profile') }}" class="mt-4 w-full rounded bg-transparent text-center text-danger font-semibold p-3 outline outline-2">Batal</a>
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