@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Tambah Data Pengemudi</title>
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
        <h3 class="fw-bold">Tambah Pengemudi</h3>
        <p class="mb-0 text-secondary">Halaman Tambah Pengemudi Baru</p>
    </div>
    <div class="d-block rounded bg-white shadow mb-3">
        <div class="d-block p-3">
            <form action="{{ route('admin.pengemudi.create.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Pengemudi</label>
                    <input type="file" name="foto" id="foto"
                        class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pengemudi</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP Pengemudi</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip') }}">
                    @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan Pengemudi</label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
                        value="{{ old('jabatan') }}">
                    @error('jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">No Telepon / Whatsapp Pengemudi</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Pengemudi</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Save</button>
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
        filebrowserUploadUrl: "{{route('admin.pengemudi.upload.editor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection