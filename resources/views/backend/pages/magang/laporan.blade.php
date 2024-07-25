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
                <table id="tables" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Jurusan</th>
                            <th>Lokasi Magang</th>
                            <th>Guru Pendamping</th>
                            <th>Periode Awal</th>
                            <th>Periode Akhir</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($magang as $key => $magangs)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$magangs->murid->nama}} </td>
                            <td> {{$magangs->murid->nis}} </td>
                            <td> {{$magangs->murid->jurusan}} </td>
                            <td> {{$magangs->mitra->nama}} </td>
                            <td> {{$magangs->mitra->pic}} </td>
                            <td> {{$magangs->periode_awal}} </td>
                            <td> {{$magangs->periode_akhir}} </td>
                            <td> {{$magangs->keterangan}} </td>
                            <td>
                                @if ($magangs->is_active == 1)
                                    <button class="btn btn-sm btn-success">aktif</button>
                                @else
                                    <button class="btn btn-sm btn-secondary">selesai</button>
                                @endif
                            </td>

                            <td>
                                <div style="width:100px">
                                    <a href="{{ route('magang.edit', $magangs->id) }}" class="btn">
                                        <button class="badge bg-warning border-0">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route ('magang.destroy', $magangs->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah Kamu Ingin Menghapus Ini?')">
                                            <i class="fas fa-trash align-items-center"></i>
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
