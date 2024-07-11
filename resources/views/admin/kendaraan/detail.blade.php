@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Kendaraan {{ $data->title }}</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">Detail Kendaraan</p>
        <p class="mb-0">Halaman Detail Kendaraan {{ $data->title }}</p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.kendaraan.register', ['post' => $data->id_kendaraan])
    </div>
</div>
@endsection

@section('script')

@endsection