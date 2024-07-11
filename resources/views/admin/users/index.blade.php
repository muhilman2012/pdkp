@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Data Users</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">Users</p>
        <p class="mb-0">Halaman Data Users</p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.users.data')
    </div>
</div>
@endsection

@section('script')

@endsection