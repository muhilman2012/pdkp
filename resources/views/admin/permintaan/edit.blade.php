@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Update Data Permintaan</title>
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
    <div class="d-block rounded bg-white shadow mb-3">
        <div class="p-3 border-bottom">
            <p class="fs-4 fw-bold mb-0">Update Data Permintaan</p>
        </div>
        
    </div>
    <div class="d-block mt-1 mb-1 p-3" style="background-color:rgb(240, 240, 240)">
        <div class="row">
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
        </div>
    </div>
    <div class="d-block rounded bg-white shadow p-5">
        <div class="border-bottom mb-4">
            <p class="fs-5 fw-bold">Konfirmasi Permintaan</p>
        </div>
            
        <form action="{{ route('admin.permintaan.update', ['id' => $data->id_permintaan]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3 row">
                <div class="col-md-6 mb-2">
                    <label for="pengemudi" class="form-label fw-bold">Pengemudi</label>
                    <select name="pengemudi_id" id="pengemudi" class="form-control @error('pengemudi_id') is-invalid @enderror">
                        <option value="">Pilih Pengemudi</option>
                        @foreach($pengemudi as $jabatan => $pengemudis)
                            <optgroup label="{{ $jabatan }}">
                                @foreach($pengemudis as $item)
                                    <option value="{{ $item->id }}" {{ $data->pengemudi_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('pengemudi_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="kendaraan" class="form-label fw-bold">Kendaraan</label>
                    <select name="kendaraan_id" id="kendaraan" class="form-control @error('kendaraan_id') is-invalid @enderror">
                        <option value="">Pilih Kendaraan</option>
                        @foreach($kendaraan as $item)
                            <option value="{{ $item->id }}" {{ $data->kendaraan_id == $item->id ? 'selected' : '' }}>{{ $item->name }} - {{ $item->nopol }} - {{ $item->warna }}</option>
                        @endforeach
                    </select>
                    @error('kendaraan_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">Pilih Status</option>
                        <option value="BARU" {{ $data->status == 'BARU' ? 'selected' : '' }}>BARU</option>
                        <option value="DIKONFIRMASI" {{ $data->status == 'DIKONFIRMASI' ? 'selected' : '' }}>DIKONFIRMASI</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="pesan" class="form-label fw-bold">Pesan <small>(opsional)</small></label>
                    <textarea name="pesan" id="text" rows="1" class="form-control @error('pesan') is-invalid @enderror">{{ $data->pesan }}</textarea>
                    @error('pesan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="my-3 mx-auto form-btn" style="width:200px;">
                        <button type="submit" class="btn btn-primary form-control ">Update</button>
                    </div>
                </div>
            </div>
            
        </form>
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