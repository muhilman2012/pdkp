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
    <div class="d-block rounded bg-white shadow">
        <div class="p-3 border-bottom">
            <p class="fs-4 fw-bold mb-0">Update Data Permintaan</p>
        </div>
        <div class="d-block p-3">
            <form action="{{ route('admin.permintaan.update', ['id' => $data->id_permintaan]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="layanan" class="form-label">Layanan</label>
                        <select name="layanan" id="layanan" class="form-control @error('layanan') is-invalid @enderror" disabled>
                            <option value="">Pilih Layanan</option>
                            <option value="Wapres" {{ $data->layanan == 'Wapres' ? 'selected' : '' }}>Wapres</option>
                            <option value="Tamu" {{ $data->layanan == 'Tamu' ? 'selected' : '' }}>Tamu</option>
                            <option value="Eselon" {{ $data->layanan == 'Eselon' ? 'selected' : '' }}>Eselon</option>
                            <option value="Pegawai" {{ $data->layanan == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
                        @error('layanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="text" name="waktu" id="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ $data->waktu }}" disabled>
                        @error('waktu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="pengguna" class="form-label">Pengguna</label>
                        <input type="text" name="pengguna" id="pengguna" class="form-control @error('pengguna') is-invalid @enderror" value="{{ $data->pengguna }}" disabled>
                        @error('pengguna')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Nomor Telepon / Whatsapp</label>
                        <input type="phone" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $data->phone }}" disabled>
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="capacity" class="form-label">Jumlah Penumpang</label>
                        <input type="text" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $data->capacity }}" disabled>
                        @error('capacity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tipe_perjalanan" class="form-label">Pilih Tipe Perjalanan</label>
                        <select name="tipe_perjalanan" class="form-control @error('tipe_perjalanan') is-invalid @enderror" disabled>
                            <option value="">Pilih Tipe Perjalanan</option>
                            <option value="Sekali Jalan" {{ $data->tipe_perjalanan == 'Sekali Jalan' ? 'selected' : '' }}>Sekali Jalan</option>
                            <option value="Pulang Pergi" {{ $data->tipe_perjalanan == 'Pulang Pergi' ? 'selected' : '' }}>Pulang Pergi</option>
                        </select>
                        @error('tipe_perjalanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ $data->date }}" readonly>
                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jam_awal" class="form-label">Jam Pengantaran</label>
                        <input type="time" name="jam_awal" id="jam_awal" class="form-control @error('jam_awal') is-invalid @enderror" value="{{ $data->jam_awal }}" readonly>
                        @error('jam_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jam_akhir" class="form-label">Jam Penjemputan</label>
                        <input type="time" name="jam_akhir" id="jam_akhir" class="form-control @error('jam_akhir') is-invalid @enderror" value="{{ $data->jam_akhir }}" readonly>
                        @error('jam_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="tujuan_awal" class="form-label">Dari</label>
                        <input type="text" name="tujuan_awal" id="tujuan_awal" class="form-control @error('tujuan_awal') is-invalid @enderror" value="{{ $data->tujuan_awal }}" disabled>
                        @error('tujuan_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tujuan_akhir" class="form-label">Ke</label>
                        <input type="text" name="tujuan_akhir" id="tujuan_akhir" class="form-control @error('tujuan_akhir') is-invalid @enderror" value="{{ $data->tujuan_akhir }}" disabled>
                        @error('tujuan_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="file" class="form-label">Surat Tugas yang Diupload</label><br>
                        @if($data->file)
                            <a href="{{ asset('/storage/file/surat_tugas/' . $data->file) }}" target="_blank">{{ $data->file }}</a>
                        @else
                            <span>Tidak ada file yang diupload</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="pengemudi" class="form-label">Pengemudi</label>
                        <select name="pengemudi_id" id="pengemudi" class="form-control @error('pengemudi_id') is-invalid @enderror">
                            <option value="">Pilih Pengemudi</option>
                            @foreach($pengemudi as $item)
                                <option value="{{ $item->id }}" {{ $data->pengemudi_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('pengemudi_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="kendaraan" class="form-label">Kendaraan</label>
                        <select name="kendaraan" id="kendaraan" class="form-control @error('kendaraan') is-invalid @enderror">
                            <option value="">Pilih Kendaraan</option>
                            @foreach($kendaraan as $item)
                                <option value="{{ $item->name }}" {{ $data->kendaraan_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('kendaraan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">Pilih Status</option>
                            <option value="BARU" {{ $data->status == 'BARU' ? 'selected' : '' }}>BARU</option>
                            <option value="DIKONFIRMASI" {{ $data->status == 'DIKONFIRMASI' ? 'selected' : '' }}>DIKONFIRMASI</option>
                            <option value="DALAM PERJALANAN" {{ $data->status == 'DALAM PERJALANAN' ? 'selected' : '' }}>DALAM PERJALANAN</option>
                            <option value="SELESAI" {{ $data->status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Deskripsi Keperluan</label>
                    <textarea name="keperluan" id="editors" rows="3" class="form-control @error('keperluan') is-invalid @enderror" disabled>{{ $data->keperluan }}</textarea>
                    @error('keperluan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan <small>(opsional)</small></label>
                    <textarea name="pesan" id="text" rows="1" class="form-control @error('pesan') is-invalid @enderror">{{ $data->pesan }}</textarea>
                    @error('pesan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-secondary form-control">Update</button>
                </div>
            </form>
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
@endsection