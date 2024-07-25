@extends('layouts.app')

@section('content.wrapper')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <!-- <div class="container-fluid">
        <div class="col-6 card shadow-sm p-5">
            <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
            <h5 class="text-muted">Aplikasi Penilaian Kinerja Dosen</h5>
        </div>     
    </div> -->
    @if (Auth::user()->role == 'admin')
    <div class="row">
        <div class="col-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$jumlahMitra}}</h3>
                    <p>Mitra</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{route('mitra.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{$jumlahMurid}}</h3>
                    <p>Siswa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{route('murid.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$jumlahGuru}}</h3>
                    <p>Guru</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="{{route('guru.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-3">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{$jumlahMagangAktif}}</h3>
                    <p>Siswa Magang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{route('data-magang')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    @elseif (Auth::user()->role == 'siswa')
    <div class="container-fluid">
        <div class="col-6 card shadow-sm p-5">
            <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
            <h5 class="text-muted"></h5>
        </div>     
    </div>
    @endif
    
</section>
@endsection
