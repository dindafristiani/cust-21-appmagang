@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Murid</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('murid.index') }}">
                            Data Murid
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Data Murid</li>
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
                    <form method="post" action="{{ route('murid.update', $murid->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Murid</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value=" {{$murid->user->name}} " />
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
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{$murid->user->email}} " />
                                        @error('email')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">NIS Murid</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value=" {{$murid->nis}} " />
                                        @error('nis')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label> <span class="text-danger">*</span>
                                        <select class="form-select @error('jurusan') is-invalid @enderror" name="jurusan">
                                            <option value="">Pilih Jurusan</option>
                                            <option value="TITL" {{ (old('jurusan') ?? $murid->jurusan) == 'TITL' ? 'selected' : '' }}>TITL</option>
                                            <option value="TP" {{ (old('jurusan') ?? $murid->jurusan) == 'TP' ? 'selected' : '' }}>TP</option>
                                            <option value="TPL" {{ (old('jurusan') ?? $murid->jurusan) == 'TPL' ? 'selected' : '' }}>TPL</option>
                                            <option value="TKR" {{ (old('jurusan') ?? $murid->jurusan) == 'TKR' ? 'selected' : '' }}>TKR</option>
                                            <option value="TSM" {{ (old('jurusan') ?? $murid->jurusan) == 'TSM' ? 'selected' : '' }}>TSM</option>
                                            <option value="TBSM" {{ (old('jurusan') ?? $murid->jurusan) == 'TBSM' ? 'selected' : '' }}>TBSM</option>
                                            <option value="TKRO" {{ (old('jurusan') ?? $murid->jurusan) == 'TKRO' ? 'selected' : '' }}>TKRO</option>
                                            <option value="TPM" {{ (old('jurusan') ?? $murid->jurusan) == 'TPM' ? 'selected' : '' }}>TPM</option>
                                            <option value="TIPTL" {{ (old('jurusan') ?? $murid->jurusan) == 'TIPTL' ? 'selected' : '' }}>TIPTL</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Kelas</label> <span class="text-danger">*</span>
                                        <select class="form-select @error('kelas') is-invalid @enderror" name="kelas">
                                            <option value="">--Pilih Kelas--</option>
                                            <option value="X" {{ (old('kelas') ?? $murid->kelas) == 'X' ? 'selected' : '' }}>X</option>
                                            <option value="XI" {{ (old('kelas') ?? $murid->kelas) == 'XI' ? 'selected' : '' }}>XI</option>
                                            <option value="XII" {{ (old('kelas') ?? $murid->kelas) == 'XII' ? 'selected' : '' }}>XII</option>
                                        </select>
                                        @error('kelas')
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

<script src="{{ asset('admin/ckeditor5/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('content');
</script>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        
        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    }
</script>

@endpush
