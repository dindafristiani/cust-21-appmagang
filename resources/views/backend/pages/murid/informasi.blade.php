@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Informasi Magang</h1>
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Data Siswa</li>
                </ol>
            </div> -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="col-6">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <h5><strong>{{ $magangs->mitra->nama }}</strong></h5>
                    <p class="text-secondary">{{ $magangs->mitra->alamat }} - {{ $magangs->mitra->nohp }}</p>
                    <p class="text-muted" style="margin: 0; padding: 0;">{{ \Carbon\Carbon::parse($magangs->periode_awal)->translatedFormat('j F Y') }} - {{ \Carbon\Carbon::parse($magangs->periode_akhir)->translatedFormat('j F Y') }}
                    </p>
                    <span class="text-success">
                        <i class="fas fa-circle fa-xs"></i> Aktif
                    </span>

                    <p>Pembimbing Lapangan : {{ $magangs->mitra->pic }}</p>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
