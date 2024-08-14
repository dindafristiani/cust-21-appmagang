@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Magang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Data Magang</li>
                </ol>
            </div>
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
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                
                <div class="row">
                    
                    <div class="col-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="col-2"><strong>Nama Perusahaan</strong></td>
                                    <td>: {{ $mitra->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $mitra->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>PIC</strong></td>
                                    <td>: {{ $mitra->pic }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No HP</strong></td>
                                    <td>: {{ $mitra->nohp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan</strong></td>
                                    <td>: {{ $mitra->jurusan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Periode Awal</th>
                                    <th>Periode Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mitra->magangs as $key => $magang)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $magang->murid->nama }}</td>
                                        <td>{{ $magang->murid->nis }}</td>
                                        <td>{{ $magang->murid->kelas }}</td>
                                        <td>{{ $magang->murid->jurusan }}</td>
                                        <td>{{ $magang->periode_awal }}</td>
                                        <td>{{ $magang->periode_akhir }}</td>
                                        <td>{{ $magang->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
