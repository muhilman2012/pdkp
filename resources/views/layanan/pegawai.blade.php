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
            <img class="w-12" src="{{ asset('/assets/logo/logo-sekwapres.svg') }}" alt="Logo SETWAPRES">
            <img class="w-4/12 h-fit" src="{{ asset('/assets/logo/logo-pdkp-gold.png') }}" alt="Logo PDKP">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <a href="{{ route('pages.layanan') }}">
                <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            </a>
            <p class="font-bold text-lg leading-5 w-full">Dukungan Layanan Untuk Pegawai</p>
        </div>

        <div class="flex flex-col gap-6 w-full mt-6">
            <form action="{{ route('layanan.pegawai.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex flex-col w-full gap-4">
                    <label class="text-black font-medium text-[14px]">Waktu</label>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="col-span-1 items-center">
                            <input id="jam_kerja" name="waktu" type="radio" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            <label for="jam_kerja" class="text-black font-medium text-[14px]">Jam Kerja</label>
                            @error('jam_kerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-1 items-center">
                            <input id="luar_jam_kerja" name="waktu" type="radio" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            <label for="luar_jam_kerja" class="text-black font-medium text-[14px]">Luar Jam Kerja / Lembur</label>
                            @error('luar_jam_kerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="keperluan" class="text-black font-medium text-[14px]">Deskripsi Keperluan</label>
                        <textarea id="keperluan" name="keperluan" rows="3" placeholder="masukkan deskripsi keperluan permintaan kendaraan" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold"></textarea>
                        @error('keperluan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex justify-between gap-4 w-full">
                        <div class="flex flex-col w-full gap-1">
                            <label for="date" class="text-black font-medium text-[14px]">Tanggal</label>
                            <input id="date" name="date" type="date" placeholder="pilih tanggal" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <label class="text-black font-medium text-[14px]">Jenis Pengguna</label>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="col-span-1 items-center">
                            <input id="untuk_diri_sendiri" name="jenis_pengguna" type="radio" value="sendiri" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" onchange="togglePenggunaFields()">
                            <label for="untuk_diri_sendiri" class="text-black font-medium text-[14px]">Untuk Diri Sendiri</label>
                        </div>
                        <div class="col-span-1 items-center">
                            <input id="untuk_pengguna_lain" name="jenis_pengguna" type="radio" value="lain" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" onchange="togglePenggunaFields()">
                            <label for="untuk_pengguna_lain" class="text-black font-medium text-[14px]">Untuk Pengguna Lain</label>
                        </div>
                    </div>
                    <div id="pengguna_fields" class="hidden">
                        <div class="flex flex-col w-full gap-1">
                            <label for="pengguna" class="text-black font-medium text-[14px]">Nama Penumpang</label>
                            <input id="pengguna" name="pengguna" type="text" placeholder="masukkan nama penumpang" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('pengguna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full gap-1">
                            <label for="phone" class="text-black font-medium text-[14px]">No. HP / Whatsapp Penumpang</label>
                            <input id="phone" name="phone" type="text" placeholder="masukkan no telp/whatsapp penumpang" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="flex flex-col w-full gap-1 col-span-1">
                            <label for="capacity" class="text-black font-medium text-[14px]">Jumlah Penumpang</label>
                            <input id="capacity" name="capacity" type="number" placeholder="isi jumlah penumpang" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('capacity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full gap-1 col-span-1">
                            <label class="text-black font-medium text-[14px]">Tipe Perjalanan</label>
                            <div class="grid grid-cols-2 gap-4 w-full">
                                <div class="flex items-center">
                                    <input id="satu_arah" name="tipe_perjalanan" type="radio" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                                    <label for="satu_arah" class="text-black font-medium text-[14px] ml-2">Sekali Jalan</label>
                                    @error('satu_arah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <input id="pulang_pergi" name="tipe_perjalanan" type="radio" class="mt-[4px] bg-white p-[12px] rounded w-fit focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                                    <label for="pulang_pergi" class="text-black font-medium text-[14px] ml-2">Pulang Pergi</label>
                                    @error('pulang_pergi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="text-black font-medium text-[14px]">Tempat Tujuan</label>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="col-span-1 items-center">
                            <label for="tujuan_awal" class="text-black font-medium text-[14px]">Dari</label>
                            <input id="tujuan_awal" name="tujuan_awal" type="text" placeholder="tempat titik awal" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('tujuan_awal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-1 items-center">
                            <label for="tujuan_akhir" class="text-black font-medium text-[14px]">Ke</label>
                            <input id="tujuan_akhir" name="tujuan_akhir" type="text" placeholder="tempat titik akhir" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('tujuan_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <label class="text-black font-medium text-[14px]">Jam</label>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="col-span-1 items-center">
                            <label for="jam_awal" class="text-black font-medium text-[14px]">Jam Pengantaran</label>
                            <input id="jam_awal" name="jam_awal" type="time" placeholder="jam pengantaran" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('jam_awal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-1 items-center">
                            <label for="jam_akhir" class="text-black font-medium text-[14px]">Jam Penjemputan</label>
                            <input id="jam_akhir" name="jam_akhir" type="time" placeholder="jam penjemputan" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                            @error('jam_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-1">
                        <label for="file" class="text-black font-medium text-[14px]">Upload Surat Tugas <small>(jika ada)</small></label>
                        <input id="file" name="file" type="file" class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold">
                        @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div><br>
                <button class="w-full rounded bg-gold text-white font-semibold p-3 hover:bg-[#B57F21] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:border-white">Ajukan</button>
            </form>
        </div>
    </section>

    <script>
        function togglePenggunaFields() {
            var untukDiriSendiri = document.getElementById('untuk_diri_sendiri');
            var penggunaFields = document.getElementById('pengguna_fields');
            if (untukDiriSendiri.checked) {
                penggunaFields.classList.add('hidden');
            } else {
                penggunaFields.classList.remove('hidden');
            }
        }
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