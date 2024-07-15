@extends('admin.layouts.panel')

@section('head')
    <title>PDKP - Dashboard Admin</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">PDKP Sekretariat Wakil Presiden RI</p>
        <p class="mb-0">Halo, {{auth('admin')->user()->username}} </p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.permintaan.dashboard')
    </div>
</div>
@endsection

@section('script')
    
@endsection