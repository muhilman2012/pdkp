@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Users {{ $data->title }}</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        <p class="fs-4 fw-bold mb-0">Detail Users</p>
        <p class="mb-0">Halaman Detail Users {{ $data->title }}</p>
    </div>
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
        @livewire('admin.users.register', ['post' => $data->id_users])
    </div>
</div>
@endsection

@section('script')

@endsection