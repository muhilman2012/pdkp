@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Permintaan {{ $data->uuid }}</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">Detail Permintaan</p>
        <p class="mb-0">Halaman Detail Permintaan {{ $data->pengguna }}</p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.permintaan.edit', ['post' => $data->id_permintaan])
    </div>
</div>
@endsection

@section('script')

@endsection