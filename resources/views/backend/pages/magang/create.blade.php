@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Magang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('magang.index') }}">
                            Data Magang
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Data Magang</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-8">
                    <form method="post" action="{{ route('magang.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Mitra</label> <span class="text-danger">*</span>
                                        <select class="form-control @error('id_mitra') is-invalid @enderror" name="id_mitra" style="width: 100%;" id="js-example-basic-single">
                                            <option value="">Pilih Mitra Magang</option>
                                            @if(isset($mitra))
                                                <!-- Jika ID mitra sudah diketahui -->
                                                <option value="{{ $mitra->id }}" selected>{{ $mitra->nama }}</option>
                                            @else
                                                <!-- Jika ID mitra tidak diketahui, opsi akan dimuat melalui AJAX -->
                                            @endif
                                        </select>
                                        @error('id_mitra')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="periode_awal">Periode Awal</label> <span class="text-danger">*</span>
                                                <input type="date" class="form-control @error('periode_awal') is-invalid @enderror" name="periode_awal" id="periode_awal" required>
                                                @error('periode_awal')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="periode_akhir">Periode Akhir</label> <span class="text-danger">*</span>
                                                <input type="date" class="form-control @error('periode_akhir') is-invalid @enderror" name="periode_akhir" id="periode_akhir" required>
                                                @error('periode_akhir')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Siswa</label> <span class="text-danger">*</span>
                                        <select class="form-control @error('id_siswa') is-invalid @enderror" name="id_siswa[]" style="width: 100%;" id="js-example-basic-single2" multiple="multiple">
                                            <option value="">Pilih Nama Siswa</option>
                                            <!-- Tambahkan opsi-opsi select di sini -->
                                        </select>
                                        @error('id_siswa')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('b-script')

<script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2({
            placeholder: 'Pilih Mitra Magang',
            ajax: {
                url: '{{ route("get-mitra") }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.nama
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#js-example-basic-single2').select2({
            placeholder: 'Pilih Nama Siswa',
            ajax: {
                url: '{{ route("get-siswa") }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.nama
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>

@endpush
