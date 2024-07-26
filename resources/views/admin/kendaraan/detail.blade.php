@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Kendaraan</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <div class="p-3 border-bottom">
            <p class="fs-4 fw-bold mb-0">Detail Kendaraan</p>
        </div>
        <div class="d-block p-3">
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <p class="text-label fw-bold mb-1 ">Nama Mobil :</p>
                        <p>{{ $data->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Merk Mobil :</p>
                        <p>{{ $data->merk }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Tipe Mobil :</p>
                        <p>{{ $data->type }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Nomor Polisi :</p>
                        <p>{{ $data->nopol }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Jenis Bensin :</p>
                        <p>{{ $data->jenis_bensin }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Model Mobil :</p>
                        <p>{{ $data->model }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Warna Mobil :</p>
                        <p>{{ $data->warna }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Foto :</p>
                        <img src="{{ url('/images/kendaraan/' . $data->foto ) }}" class="rounded" width="100px">
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Kategori :</p>
                        <p>{{ $data->kategori }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Tahun Mobil :</p>
                        <p>{{ $data->tahun }}</p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection