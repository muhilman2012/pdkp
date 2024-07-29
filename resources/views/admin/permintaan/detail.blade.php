@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Data Permintaan</title>
<style>
    .ck-editor__editable {
        min-height: 200px;
        box-shadow: unset !important;
        border-radius: 0px 0px 4px 4px !important;
    }
</style>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded bg-white shadow">
        <div class="p-3 border-bottom">
            <p class="fs-4 fw-bold mb-0">Detail Data Permintaan</p>
        </div>
        <div class="d-block p-3">
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Layanan :</p>
                        @switch($data->layanan)
                            @case("Wapres")
                                <p>Wapres</p>
                                 @break
                            @case("Tamu")
                                <p>Tamu</p>
                                @break
                            @case("Eselon")
                                <p>Eselon</p>
                                @break
                            @case("Pegawai")
                                <p>Pegawai</p>
                                @break
                        @endswitch
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Waktu :</p>
                        @switch($data->waktu)
                            @case("Jam Kerja")
                                <p>Jam Kerja</p>
                            @break
                            @case("Luar Jam Kerja")
                                <p>Luar Jam Kerja</p>
                            @break
                        @endswitch
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Pengguna :</p>
                        <p>{{ $data->pengguna }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Nomor Telepon/Whatsapp :</p>
                        <p>{{ $data->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Jumlah Penumpang :</p>
                        <p>{{ $data->capacity }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Pilih Tipe Perjalanan :</p>
                        @switch($data->tipe_perjalanan)
                            @case("Sekali Jalan")
                                <p>Sekali Jalan</p>
                            @break
                            @case("Pulang Pergi")
                                <p>Pulang Pergi</p>
                            @break
                        @endswitch
                        
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Tanggal :</p>
                        <p>{{ $data->date }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Jam Pengantaran :</p>
                        <p>{{ $data->jam_awal }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Jam Penjemputan :</p>
                        <p>{{ $data->jam_akhir }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Dari :</p>
                        <p>{{ $data->tujuan_awal }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Ke :</p>
                        <p>{{ $data->tujuan_akhir }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Surat Tugas :</p>
                        @if($data->file)
                            <a href="{{ asset('public/file/surat_tugas' . $data->file) }}" target="_blank" class="mb-1">{{ $data->file }}</a>
                        @else
                            <p>Tidak ada file yang diupload</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Deskripsi Keperluan :</p>
                        <p>{{ $data->keperluan }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Pesan :</p>
                        <p>{{ $data->pesan }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Pengemudi :</p>
                        <p>
                            @if($data->pengemudi)
                                {{ $data->pengemudi->name }}
                            @else
                                belum dikonfirmasi
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Kendaraan :</p>
                        <p>
                            @if($data->kendaraan)
                                {{ $data->kendaraan->name }}
                            @else
                                kendaraan belum dikonfirmasi
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Status :</p>
                        <p>{{ $data->status }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Review :</p>
                        <p>{{ $data->review }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Rating Operasional :</p>
                        <p>{{ $data->rating_ops }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Rating Pengemudi :</p>
                        <p>{{ $data->rating_driver }}</p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace( 'editors', {
        filebrowserUploadUrl: "{{route('admin.permintaan.upload.editor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>
@endsection