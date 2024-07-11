@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Data Pengemudi</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">Pengemudi</p>
        <p class="mb-0">Halaman Data Pengemudi</p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.pengemudi.data')
    </div>
</div>
@endsection

@section('script')

@endsection