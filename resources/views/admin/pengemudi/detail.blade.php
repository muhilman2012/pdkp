@extends('admin.layouts.panel')

@section('head')
<title>PDKP - Detail Pengemudi</title>
@endsection

@section('pages')
<div class="container-fluid">
    <div class="d-block rounded-3 bg-white shadow-sm p-3 mb-3">
    <div class="p-3 border-bottom">
            <p class="fs-4 fw-bold mb-0">Detail Pengemudi</p>
        </div>
        <div class="d-block p-3">
                <div class="mb-3 row">
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Foto :</p>
                        <img src="{{ url('/images/users/' . $data->foto ) }}" class="rounded " width="100px">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Nama :</p>
                        <p>{{ $data->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Nomor Telepon/Whatsapp :</p>
                        <p>{{ $data->phone }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Email :</p>
                        <p>{{ $data->email }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <p class="text-label fw-bold mb-1 ">Jabatan :</p>
                        <p>{{ $data->jabatan }}</p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection