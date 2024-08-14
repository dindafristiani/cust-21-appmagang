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
                        <table id="tables" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Periode Awal</th>
                                    <th>Periode Akhir</th>
                                    <th>Nilai Akhir</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($magangs as $key => $magang)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $magang->murid->nama }}</td>
                                        <td>{{ $magang->murid->nis }}</td>
                                        <td>{{ $magang->murid->kelas }}</td>
                                        <td>{{ $magang->murid->jurusan }}</td>
                                        <td>{{ $magang->periode_awal }}</td>
                                        <td>{{ $magang->periode_akhir }}</td>
                                        <td>{{ $magang->nilai}}</td>
                                        <td>{{ $magang->keterangan }}</td>
                                        <td>
                                                <div style="width:100px;">
                                                    <a href="{{ route('showLogbook.siswa', $magang->murid->id) }}" class="btn">
                                                        <button class="badge bg-blue border-0">
                                                            <i class="fas fa-book"></i>
                                                        </button>
                                                    </a>

                                                    <a href="javascript:void(0)" class="btn" data-toggle="modal" data-target="#penilaianModal{{ $magang->id }}">
                                                        <button class="badge bg-green border-0">
                                                            <i class="fas fa-clipboard-check"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <div class="modal fade" id="penilaianModal{{ $magang->id }}" tabindex="-1" role="dialog" aria-labelledby="penilaianModalLabel{{ $magang->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="penilaianModalLabel{{ $magang->id }}">Penilaian Siswa: {{ $magang->murid->nama }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('penilaian.siswa', $magang->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nilai{{ $magang->id }}">Nilai</label>
                                                        <input type="number" class="form-control" id="nilai{{ $magang->id }}" name="nilai" value="{{ $magang->nilai ?? '' }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="catatan{{ $magang->id }}">Catatan</label>
                                                        <textarea class="form-control" id="catatan{{ $magang->id }}" name="keterangan" rows="3" required>{{ $magang->keterangan ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
