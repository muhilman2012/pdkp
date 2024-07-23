@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Tambah Data Users</title>
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
        <h3 class="fw-bold">Tambah Users</h3>
        <p class="mb-0 text-secondary">Halaman Tambah Users Baru</p>
    </div>
    <div class="d-block rounded bg-white shadow mb-3">
        <div class="d-block p-5">
            <form class="add-form" action="{{ route('admin.users.create.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')    
                <div class="row">
                    <div class=" mb-3 align-items-center row">
                        <div class="col-4"><label for="nip" class="form-label staff-nip me-3">NIP</label></div>
                        <div class="col-8"><input type="text" name="nip" id="nip"  class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}"></div>
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class=" mb-3 align-items-center row">
                        <div class="col-4"><label for="name" class="form-label staff-name me-3">Nama Lengkap</label></div>
                        <div class="col-8"><input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"></div>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        
                    </div>
                    <div class=" mb-3 align-items-center row">
                        <div class="col-4"><label for="foto" class="form-label me-3">Foto </label></div>
                        <div class="col-8"><input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="foto"></div>
                        @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class=" mb-3 align-items-center row">
                        <div class="col-4"><label for="phone" class="form-label staff-position me-3">Nomor Telepon</label></div>
                        <div class="col-8"><input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"></div>
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        
                    </div>
                    <div class=" mb-3 align-items-center row">
                        <div class="col-4"><label for="email" class="form-label staff-subsection me-3">Email</label></div>
                        <div class="col-8"><input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    </div>
                    <div class="mb-3 align-items-center row">
                        <div class="col-4"><label for="unit_kerja" class="form-label car-group">Unit Kerja</label></div>
                        <div class="col-8">
                            <select class="form-select" aria-label="Select" id="unit_kerja" name="unit_kerja">
                                <option value="" disabled selected>Pilih Unit</option>
                                @foreach($divisis as $divisi)
                                    <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama }}</option>
                                @endforeach
                            </select>
                            @error('unit_kerja')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="my-4 mx-auto form-btn" style="width:200px;">
                            <button type="submit" class="btn btn-primary form-control ">Save</button>
                        </div>
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
        filebrowserUploadUrl: "{{route('admin.users.upload.editor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection