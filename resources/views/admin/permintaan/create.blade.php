@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Tambah Data Permintaan</title>
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
    <div class="d-block rounded bg-white shadow-sm p-3 mb-3">
        <h3 class="fw-bold">Tambah Permintaan</h3>
        <p class="mb-0 text-secondary">Halaman Tambah Permintaan Baru</p>
    </div>
    <div class="d-block rounded bg-white shadow mb-3">
        <div class="d-block p-3">
            <form action="{{ route('admin.permintaan.create.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="layanan" class="form-label">Pilih Layanan</label>
                        <select name="layanan" id="layanan" class="form-control @error('layanan') is-invalid @enderror">
                            <option value="">Pilih Layanan</option>
                            <option value="Wapres" {{ old('layanan') == 'Wapres' ? 'selected' : '' }}>Wapres</option>
                            <option value="Tamu" {{ old('layanan') == 'Tamu' ? 'selected' : '' }}>Tamu</option>
                            <option value="Eselon" {{ old('layanan') == 'Eselon' ? 'selected' : '' }}>Eselon</option>
                            <option value="Pegawai" {{ old('layanan') == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                        </select>
                        @error('layanan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="waktu" class="form-label">Pilih Waktu</label>
                        <select name="waktu" class="form-control @error('waktu') is-invalid @enderror">
                            <option value="">Pilih Waktu</option>
                            <option value="Jam Kerja" {{ old('waktu') == 'Jam Kerja' ? 'selected' : '' }}>Jam Kerja</option>
                            <option value="Luar Jam Kerja / Lembur" {{ old('waktu') == 'Luar Jam Kerja' ? 'selected' : '' }}>Luar Jam Kerja</option>
                        </select>
                        @error('waktu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="pengguna" class="form-label">Pengguna</label>
                        <input type="text" name="pengguna" id="pengguna"  class="form-control @error('pengguna') is-invalid @enderror" value="{{ old('pengguna') }}">
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
                        <input type="phone" name="phone" id="phone"  class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="capacity" class="form-label">Jumlah Penumpang</label>
                        <input type="text" name="capacity" id="capacity"  class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}">
                        @error('capacity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tipe_perjalanan" class="form-label">Pilih Tipe Perjalanan</label>
                        <select name="tipe_perjalanan" class="form-control @error('tipe_perjalanan') is-invalid @enderror">
                            <option value="">Pilih Tipe Perjalanan</option>
                            <option value="Sekali Jalan" {{ old('tipe_perjalanan') == 'Sekali Jalan' ? 'selected' : '' }}>Sekali Jalan</option>
                            <option value="Pulang Pergi" {{ old('tipe_perjalanan') == 'Pulang Pergi' ? 'selected' : '' }}>Pulang Pergi</option>
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
                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jam_awal" class="form-label">Jam Pengantaran</label>
                        <input type="time" name="jam_awal" id="jam_awal" class="form-control @error('jam_awal') is-invalid @enderror" value="{{ old('jam_awal') }}">
                        @error('jam_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="jam_akhir" class="form-label">Jam Penjemputan</label>
                        <input type="time" name="jam_akhir" id="jam_akhir" class="form-control @error('jam_akhir') is-invalid @enderror" value="{{ old('jam_akhir') }}">
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
                        <input type="text" name="tujuan_awal" id="tujuan_awal" class="form-control @error('tujuan_awal') is-invalid @enderror" value="{{ old('tujuan_awal') }}">
                        @error('tujuan_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tujuan_akhir" class="form-label">Ke</label>
                        <input type="text" name="tujuan_akhir" id="tujuan_akhir" class="form-control @error('tujuan_akhir') is-invalid @enderror" value="{{ old('tujuan_akhir') }}">
                        @error('tujuan_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="file" class="form-label">Upload Surat Tugas <small>(jika ada)</small></label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                        @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="pengemudi" class="form-label">Pengemudi</label>
                        <select name="pengemudi" id="pengemudi" class="form-control @error('pengemudi') is-invalid @enderror">
                            <option value="">Pilih Pengemudi</option>
                            @foreach($pengemudi as $item)
                                <option value="{{ $item->id }}" {{ old('pengemudi') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('pengemudi')
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
                                <option value="{{ $item->id }}" {{ old('kendaraan') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                            <option value="BARU" {{ old('status') == 'BARU' ? 'selected' : '' }}>BARU</option>
                            <option value="DIKONFIRMASI" {{ old('status') == 'DIKONFIRMASI' ? 'selected' : '' }}>DIKONFIRMASI</option>
                            <option value="DALAM PERJALANAN" {{ old('status') == 'DALAM PERJALANAN' ? 'selected' : '' }}>DALAM PERJALANAN</option>
                            <option value="SELESAI" {{ old('status') == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
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
                    <textarea name="keperluan" id="editors" rows="3"
                        class="form-control @error('keperluan') is-invalid @enderror">{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan <small>(opsional)</small></label>
                    <textarea name="pesan" id="text" rows="1"
                        class="form-control @error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                    @error('pesan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // ClassicEditor.create(document.querySelector("#editors"))
        // .then((newEditor) => {
        //     editor = newEditor;
        // })
        // .catch((error) => {
        //     console.error(error);
        // });
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