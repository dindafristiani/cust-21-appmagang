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
            <div class="btn float-left mt-3">
                <a href="{{ route('magang.create') }}" class="btn btn-primary float-left"><i class="fas fa-plus"></i>  Tambah Data Magang</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tables" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>PIC</th>
                            <th>Jumlah Siswa Magang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitra as $key => $mitras)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$mitras->nama}} </td>
                            <td> {{$mitras->alamat}} </td>
                            <td> {{$mitras->pic}} </td>
                            <td> {{$mitras->magangs_count}} </td>
                            <td>
                                <div style="width:100px">
                                    <a href="{{ route('mitra.edit', $mitras->id) }}" class="btn">
                                        <button class="badge bg-warning border-0">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('magang.create-from-mitra', $mitras->id) }}" class="btn">
                                        <button class="badge bg-blue border-0">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>     
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
