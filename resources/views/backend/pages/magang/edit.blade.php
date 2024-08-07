@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Magang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('magang.index') }}">
                            Data Magang
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Data Magang</li>
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
                    <form method="post" action="{{ route('magang.update', $magang->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Siswa</label> <span class="text-danger">*</span>
                                    <select class="form-control @error('id_siswa') is-invalid @enderror" name="id_siswa" style="width: 100%;" id="js-example-basic-single-siswa">
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswa as $siswa_item)
                                            <option value="{{ $siswa_item->id }}" {{ $siswa_item->id == $magang->id_siswa ? 'selected' : '' }}>
                                                {{ $siswa_item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_siswa')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Mitra</label> <span class="text-danger">*</span>
                                    <select class="form-control @error('id_mitra') is-invalid @enderror" name="id_mitra" style="width: 100%;" id="js-example-basic-single-mitra">
                                        <option value="">Pilih Mitra</option>
                                        @foreach($mitra as $mitra_item)
                                            <option value="{{ $mitra_item->id }}" {{ $mitra_item->id == $magang->id_mitra ? 'selected' : '' }}>
                                                {{ $mitra_item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_mitra')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="periode_awal">Periode Awal</label> <span class="text-danger">*</span>
                                    <input type="date" class="form-control @error('periode_awal') is-invalid @enderror" name="periode_awal" value="{{ $magang->periode_awal }}" />
                                    @error('periode_awal')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="periode_akhir">Periode Akhir</label> <span class="text-danger">*</span>
                                    <input type="date" class="form-control @error('periode_akhir') is-invalid @enderror" name="periode_akhir" value="{{ $magang->periode_akhir }}" />
                                    @error('periode_akhir')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ $magang->keterangan }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-outline-secondary" type="reset">Batal</button>
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
        $('#js-example-basic-single-siswa').select2({
            placeholder: 'Pilih Siswa',
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

        $('#js-example-basic-single-mitra').select2({
            placeholder: 'Pilih Mitra',
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
@endpush
