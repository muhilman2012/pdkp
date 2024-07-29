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

    <title>Detail Permintaan - PDKP</title>
</head>

<body>
    <section class="flex flex-col justify-start px-4 mx-auto bg-white max-w-md pt-5 pb-10 h-full text-black bg-center bg-cover bg-[url('/assets/images/bg-main.png')]">
        <div class="flex justify-between">
            <img class="w-12" src="{{ asset('/assets/logo/logo-sekwapres.svg') }}" alt="logo setwapres">
            <img class="w-4/12 h-12" src="{{ asset('/assets/logo/logo-pdkp-gold.png') }}" alt="logo pdkp">
        </div>
        <div class="flex mt-5 items-center justify-center gap-2 w-full">
            <a href="{{ route('pages.dashboard') }}">
                <ion-icon name="chevron-back-circle-outline" class="text-gold h-10 w-10"></ion-icon>
            </a>
            <p class="font-bold text-lg leading-5 w-full">Detail Permintaan Layanan {{ $permintaan->layanan }}</p>
        </div>
        <div class="flex flex-col gap-6 mt-6">
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Deskripsi Keperluan</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->keperluan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Penumpang</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->pengguna }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Waktu Permintaan</p>
                <p class="font-normal text-sm leading-5">Dibuat : {{ $permintaan->created_at }}</p>
                <p class="font-normal text-sm leading-5">Update : {{ $permintaan->updated_at }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Kendaraan dan Pengemudi</p>
                <div class="flex flex-col gap-0">
                    <div class="grid grid-cols-12">
                        <div class="col-span-3">
                            @if ($permintaan->pengemudi)
                                <img class="h-20 w-20 rounded-full" src="{{ asset('/images/pengemudi/' . $permintaan->pengemudi->foto) }}" alt="Foto Profil {{ $permintaan->pengemudi->name }}">
                            @else
                                <img class="h-20 w-20 rounded-full" src="https://ui-avatars.com/api/?background=random" alt="Avatar Default">
                            @endif
                        </div>
                        <div class="col-span-9">
                            <p class="font-semibold text-sm leading-5">{{ $permintaan->kendaraan->name }} - {{ $permintaan->warna }}</p>
                            <p class="font-bold text-sm leading-5">{{ $permintaan->nopol }}</p>
                            @if ($permintaan->pengemudi)
                                <p class="font-bold text-md text-left leading-5">{{ $permintaan->pengemudi->name }}</p>
                                <a class="text-blue-500 underline" href="https://wa.me/62{{ $permintaan->pengemudi->phone }}" target="_blank">{{ $permintaan->pengemudi->phone }}</a>
                            @else
                                <p class="font-bold text-md text-left leading-5">Belum dikonfirmasi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Lokasi dan Waktu</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->tujuan_akhir }} , {{ $permintaan->jam_awal }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Catatan</p>
                <p class="font-normal text-sm leading-5">{{ $permintaan->pesan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="font-semibold text-regular underline">Status Permintaan</p>
                <div class="flex gap-1">
                    @if($permintaan->status == 'BARU')
                        <div class="bg-warning py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">DIAJUKAN</p>
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
                    @elseif($permintaan->status == 'DIBATALKAN')
                        <div class="bg-silver py-1 px-2 rounded text-white">
                            <p class="font-bold text-xs">DIBATALKAN</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($permintaan->status == 'SELESAI')
                <div class="flex flex-col gap-2">
                    <p class="font-semibold text-regular underline">Review</p>
                    @if($permintaan->review && $permintaan->rating_ops && $permintaan->rating_driver)
                        <div class="flex flex-col gap-2">
                            <textarea class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" name="review"  rows="4" disabled>{{ $permintaan->review }}</textarea>
                            <div class="flex gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $permintaan->rating_ops)
                                        <ion-icon class="text-gold w-5 h-5" name="star"></ion-icon>
                                    @else
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline"></ion-icon>
                                    @endif
                                @endfor
                                <span>Rating Operasional</span>
                            </div>
                            <div class="flex gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $permintaan->rating_driver)
                                        <ion-icon class="text-gold w-5 h-5" name="star"></ion-icon>
                                    @else
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline"></ion-icon>
                                    @endif
                                @endfor
                                <span>Rating Driver</span>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('permintaan.review.store', ['id_permintaan' => $permintaan->id_permintaan]) }}" method="POST">
                            @csrf
                            <textarea class="mt-[4px] bg-white p-[12px] placeholder:text-placeholder rounded w-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold focus:border-gold" name="review" placeholder="beri review untuk pelayanan dan pengemudi" rows="4"></textarea>
                            <div class="mt-2">
                                <div class="mb-3">
                                    <label for="rating_ops">Rating Operasional</label>
                                    <div class="flex gap-1">
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="1" data-rating="rating_ops"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="2" data-rating="rating_ops"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="3" data-rating="rating_ops"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="4" data-rating="rating_ops"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="5" data-rating="rating_ops"></ion-icon>
                                    </div>
                                    <input type="hidden" name="rating_ops" id="rating_ops" value="0">
                                </div>
                                <div>
                                    <label for="rating_driver">Rating Driver</label>
                                    <div class="flex gap-1">
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="1" data-rating="rating_driver"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="2" data-rating="rating_driver"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="3" data-rating="rating_driver"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="4" data-rating="rating_driver"></ion-icon>
                                        <ion-icon class="text-gold w-5 h-5" name="star-outline" data-value="5" data-rating="rating_driver"></ion-icon>
                                    </div>
                                    <input type="hidden" name="rating_driver" id="rating_driver" value="0">
                                </div>
                            </div>
                            <button type="submit" class="mt-4 bg-primary text-white py-2 px-4 rounded">Kirim Review</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
        <div class="mt-10 text-center">
            <small class="italic text-black text-xs">ID Permintaan : {{ $permintaan->uuid }}</small>
        </div>
        @if($permintaan->status != 'SELESAI' && $permintaan->status != 'DIBATALKAN')
            <form action="{{ route('permintaan.cancel', ['id_permintaan' => $permintaan->id_permintaan]) }}" method="get" id="cancel-form">
                @csrf
                <button type="button" class="mt-4 w-full rounded bg-transparent text-center text-danger font-semibold p-3 outline outline-2" onclick="confirmCancel()">Batalkan Permintaan</button>
            </form>
        @endif
    </section>

    <script>
    // Auto reload kecuali status 'SELESAI'
        if ('{{ $permintaan->status }}' !== 'SELESAI') {
            setTimeout(function() {
                location.reload();
            }, 20000);
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('ion-icon');
            const ratingOpsInput = document.getElementById('rating_ops');
            const ratingDriverInput = document.getElementById('rating_driver');

            stars.forEach(star => {
                star.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    const ratingType = e.target.getAttribute('data-rating');
                    
                    if (ratingType === 'rating_ops') {
                        ratingOpsInput.value = value;
                    } else if (ratingType === 'rating_driver') {
                        ratingDriverInput.value = value;
                    }
                    
                    updateStars(value, ratingType);
                    console.log(`Rating: ${value} for ${ratingType}`);
                });
            });
        });

        function updateStars(value, ratingType) {
            const stars = document.querySelectorAll(`ion-icon[data-rating="${ratingType}"]`);
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.setAttribute('name', 'star');
                } else {
                    star.setAttribute('name', 'star-outline');
                }
            });
        }

        function confirmCancel() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda tidak akan bisa mengembalikan tindakan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Tidak, tetap simpan'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form').submit();
                }
            });
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
