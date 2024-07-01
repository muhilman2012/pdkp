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

    <title>Form Permintaan Pegawai - Pelayanan Dukungan Kendaraan & Pengemudi</title>
</head>

<body>
    <section
        class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-screen text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ asset ('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
            <img class="w-4/12 h-fit" src="{{ asset ('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            <p class="font-bold text-lg leading-5 w-full">Dukungan Layanan Untuk Pegawai</p>
        </div>

        <div class="flex flex-col gap-6 w-full mt-6">
            <div class="flex flex-col w-full gap-4">
                <div class="flex flex-col w-full gap-1">
                    <label for="deskripsi" class="text-black font-medium text-[14px]">Deskripsi Keperluan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="masukkan deskripsi keperluan permintaan kendaraan" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold"></textarea>
                </div>

                <div class="flex justify-between gap-4 w-full">
                    <div class="flex flex-col w-full gap-1">
                        <label for="tanggal" class="text-black font-medium text-[14px]">Tanggal</label>
                        <input id="date" name="date" type="date" placeholder="pilih date" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                    </div>
                </div>
                <label class="text-black font-medium text-[14px]">Lokasi</label>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <div class="col-span-1 items-center">
                        <input id="luar-kota" name="lokasi" type="radio"
                            class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                        <label for="luar-kota" class="text-black font-medium text-[14px]">Luar Kota</label>
                    </div>
                    <div class="col-span-1 items-center">
                        <input id="dalam-kota" name="lokasi" type="radio"
                            class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                        <label for="dalam-kota" class="text-black font-medium text-[14px]">Dalam Kota</label>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="no_hp" class="text-black font-medium text-[14px]">No. HP</label>
                    <input id="no_hp" name="no_hp" type="text" placeholder="masukkan no telp/hp"
                        class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="tujuan" class="text-black font-medium text-[14px]">Tempat Tujuan</label>
                    <input id="tujuan" name="tujuan" type="text" placeholder="masukkan tempat tujuan"
                        class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                </div>
                <div class="flex flex-col w-full gap-1">
                    <label for="tujuan" class="text-black font-medium text-[14px]">Upload SPRINT</label>
                    <input id="tujuan" name="tujuan" type="file"
                        class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                </div>

            </div>
            <button
                class="w-full rounded bg-gold text-white font-semibold p-3 hover:bg-[#B57F21] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Ajukan</button>
        </div>
    </section>
</body>

</html>