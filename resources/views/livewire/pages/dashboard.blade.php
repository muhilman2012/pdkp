<div wire:poll.10s>
    <div class="text-black flex flex-col mt-5">
        <h4 class="font-semibold text-regular mb-3">Info Update Layanan</h4>
        <div class="flex flex-col gap-4 w-full">
            @foreach($permintaan as $item)
                @if($item->status == 'SELESAI')
                    @continue
                @endif
                @php
                    $bgColor = '';
                    if ($item->status == 'BARU') {
                        $bgColor = 'bg-warning';
                    } elseif ($item->status == 'DIKONFIRMASI') {
                        $bgColor = 'bg-yellow';
                    } elseif ($item->status == 'DALAM PERJALANAN') {
                        $bgColor = 'bg-blue';
                    } elseif ($item->status == 'SELESAI') {
                        $bgColor = 'bg-success';
                    }
                @endphp
                <a href="{{ route('pages.detail', ['id' => $item->id]) }}" class="flex bg-white p-3 rounded-lg shadow-md gap-3 items-start w-full">
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
                                <p class="font-bold text-xs">{{ $item->status }}</p>
                            </div>
                        </div>
                        <p class="font-semibold text-sm line-clamp-3">{{ $item->keperluan }}</p>
                        <div class="flex justify-between items-center italic text-black text-xs">
                            <p>{{ $item->pengemudi }} , {{ $item->kendaraan }}</p>
                            <p>ID Permintaan : {{ $item->uuid }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>