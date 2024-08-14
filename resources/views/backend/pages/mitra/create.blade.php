@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Mitra</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mitra.index') }}">
                            Data Mitra
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Mitra</li>
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
                    <form method="post" action="{{ route('mitra.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Mitra</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama Mitra" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Email</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Alamat</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan Alamat Lengkap Mitra" />
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">No Handphone</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" placeholder="628086xxxxx" />
                                        @error('nohp')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Pembimbing Lapangan</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('pic') is-invalid @enderror" name="pic" placeholder="Nama Pembimbing Lapangan" />
                                        @error('pic')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label> <span class="text-danger">*</span>
                                        <select class="form-control @error('jurusan') is-invalid @enderror" name="jurusan">
                                            <option value="">Pilih Jurusan</option>
                                            <option value="TITL" {{ old('jurusan') == 'TITL' ? 'selected' : '' }}>TITL</option>
                                            <option value="TP" {{ old('jurusan') == 'TP' ? 'selected' : '' }}>TP</option>
                                            <option value="TPL" {{ old('jurusan') == 'TPL' ? 'selected' : '' }}>TPL</option>
                                            <option value="TKR" {{ old('jurusan') == 'TKR' ? 'selected' : '' }}>TKR</option>
                                            <option value="TSM" {{ old('jurusan') == 'TSM' ? 'selected' : '' }}>TSM</option>
                                            <option value="TBSM" {{ old('jurusan') == 'TBSM' ? 'selected' : '' }}>TBSM</option>
                                            <option value="TKRO" {{ old('jurusan') == 'TKRO' ? 'selected' : '' }}>TKRO</option>
                                            <option value="TPM" {{ old('jurusan') == 'TPM' ? 'selected' : '' }}>TPM</option>
                                            <option value="TIPTL" {{ old('jurusan') == 'TIPTL' ? 'selected' : '' }}>TIPTL</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Guru Pendamping</label> <span class="text-danger">*</span>
                                        <select class="form-control @error('id_guru') is-invalid @enderror" name="id_guru" style="width: 100%;" id="js-example-basic-single">
                                            <option value="">Pilih Guru Pendamping</option>
                                             Tambahkan opsi-opsi select di sini 
                                        </select>
                                        @error('id_guru')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div> -->
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
            placeholder: 'Pilih Guru Pendamping',
            ajax: {
                url: '{{ route("get-guru") }}',
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
