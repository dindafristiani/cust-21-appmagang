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
        <div class="card">
            <div class="container">
            <h1 class="text-center">Informasi Magang</h1>
            <div class="magang-info">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        @forelse($magangs as $magang)
                        <tbody>
                            <tr>
                                <th>Nama Siswa</th>
                                <td>{{ $magang->murid->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIS</th>
                                <td>{{ $magang->murid->nis }}</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $magang->murid->kelas }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>{{ $magang->murid->jurusan }}</td>
                            </tr>
                            <tr>
                                <th>Nama Mitra</th>
                                <td>{{ $magang->mitra->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Mitra</th>
                                <td>{{ $magang->mitra->alamat }}</td>
                            </tr>
                            <tr>
                                <th>PIC Mitra</th>
                                <td>{{ $magang->mitra->pic }}</td>
                            </tr>
                            <tr>
                                <th>No HP Mitra</th>
                                <td>{{ $magang->mitra->nohp }}</td>
                            </tr>
                            <tr>
                                <th>Periode</th>
                                <td>{{ $magang->periode_awal }} - {{ $magang->periode_akhir }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $magang->is_active ? 'Aktif' : 'Selesai' }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $magang->keterangan }}</td>
                            </tr>
                            <tr>
                                <th>Nama Guru</th>
                                <td>{{ $magang->mitra->guru ? $magang->mitra->guru->nama : '-' }}</td>
                            </tr>
                            <tr>
                                <th>NIP Guru</th>
                                <td>{{ $magang->mitra->guru ? $magang->mitra->guru->nip : '-' }}</td>
                            </tr>
                            <tr>
                                <th>No HP Guru</th>
                                <td>{{ $magang->mitra->guru ? $magang->mitra->guru->nohp : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @empty
                        <p>Tidak ada informasi magang yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>    
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
