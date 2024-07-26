@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Ubah Data Kendaraan</title>
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
            <p class="fs-4 fw-bold mb-0">Edit Data Kendaraan</p>
        </div>
        <div class="d-block p-3">
            <form action="{{ route('admin.kendaraan.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Kendaraan</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ $data->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="merk" class="form-label">Merk Kendaraan</label>
                            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror"
                                value="{{ $data->merk }}">
                            @error('merk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="type" class="form-label">Tipe Kendaraan</label>
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror"
                                value="{{ $data->type }}">
                            @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="nopol" class="form-label">Nomor Polisi Kendaraan</label>
                            <input type="text" name="nopol" class="form-control @error('nopol') is-invalid @enderror"
                                value="{{ $data->nopol }}">
                            @error('nopol')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="jenis_bensin" class="form-label">Jenis Bensin Kendaraan</label>
                            <input type="text" name="jenis_bensin" class="form-control @error('jenis_bensin') is-invalid @enderror"
                                value="{{ $data->jenis_bensin }}">
                            @error('jenis_bensin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>                                                                  
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="model" class="form-label">Model Kendaraan</label>
                            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"
                                value="{{ $data->model }}">
                            @error('model')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>                                                          
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="warna" class="form-label">Warna Kendaraan</label>
                            <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror"
                                value="{{ $data->warna }}">
                            @error('warna')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="kategori" class="form-label">Kategori Kendaraan</label>
                            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                                value="{{ $data->kategori }}">
                            @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="rute" class="form-label">Rute Kendaraan</label>
                            <input type="text" name="rute" class="form-control @error('rute') is-invalid @enderror"
                                value="{{ $data->rute }}">
                            @error('rute')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5 me-2 ">
                        <div class="mb-4">
                            <label for="tahun" class="form-label">Tahun Kendaraan</label>
                            <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                value="{{ $data->tahun }}">
                            @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="my-4 mx-auto form-btn" style="width:200px;">
                        <button type="submit" class="btn btn-primary form-control ">Update</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace( 'editors', {
        filebrowserUploadUrl: "{{route('admin.kendaraan.upload.editor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection