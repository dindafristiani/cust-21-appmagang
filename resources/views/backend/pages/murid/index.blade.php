@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Siswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Data Siswa</li>
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
                <a href="{{ route('murid.create') }}" class="btn btn-primary float-left"><i class="fas fa-plus"></i>  Tambah Data Siswa</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tables" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($murid as $key => $murids)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$murids->nama}} </td>
                            <td> {{$murids->user->email}}</td>
                            <td> {{$murids->nis}} </td>
                            <td> {{$murids->kelas}} </td>
                            <td> {{$murids->jurusan}} </td>
                            <td>
                                <div style="width:100px">
                                    <a href="{{ route('murid.edit', $murids->id) }}" class="btn">
                                        <button class="badge bg-warning border-0">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route ('murid.destroy', $murids->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah Kamu Ingin Menghapus Ini?')">
                                            <i class="fas fa-trash-alt align-items-center"></i>
                                        </button>
                                    </form>
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
