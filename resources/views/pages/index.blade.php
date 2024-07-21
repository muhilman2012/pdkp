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

    <style>
        :root {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
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

    <title>PDKP - Pelayanan Dukungan Kendaraan & Pengemudi</title>
</head>

<body>
    <section
        class="flex flex-col justify-center px-4 mx-auto bg-white max-w-md h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-with-cars.png')]">
        <div class="flex flex-col gap-y-4 h-fit justify-center items-center ">
            <img class="w-12" src="{{ url('/assets/logo/logo-sekwapres.svg') }}" alt="Logo Sekretariat Wakil Presiden">
            <h4 class="text-white text-2xl font-semibold">Selamat Datang</h4>
            <img class="w-7/12 h-fit" src="{{ url('/assets/logo/logo-pdkp.png') }}" alt="Logo PDKP">
        </div>
        <div class="flex flex-col justify-center items-start gap-y-7 mt-20">
            <h2 class="text-white text-4xl font-bold">LOG IN</h2>
            <div class="flex flex-col gap-6 w-full">
                @if(request()->has('error'))
                    <div class="alert alert-danger">
                        {{ request()->get('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('pages.index.store') }}">
                    @csrf
                    <div class="flex flex-col w-full gap-4">
                        <div class="flex flex-col w-full">
                            <label for="email" class="text-white font-medium text-[14px]">Email</label>
                            <input id="email" name="email" type="text" placeholder="masukkan email"
                                class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="password" class="text-white font-medium text-[14px]">Password</label>
                            <input id="password" name="password" type="password" placeholder="masukkan password"
                                class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="user_type" class="text-white font-medium text-[14px]">Login sebagai</label>
                            <select id="user_type" name="user_type" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                                <option value="user">User</option>
                                <option value="pengemudi">Pengemudi</option>
                            </select>
                            @error('user_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="w-full rounded font-semibold bg-gold text-white p-3 hover:bg-[#B57F21] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Masuk</button>
                </form>
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