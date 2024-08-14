@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Guru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('guru.index') }}">
                            Data Guru
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Data Guru</li>
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
                    <form method="post" action="{{ route('guru.update', $guru->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Lengkap</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value=" {{$guru->nama}} " />
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
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{$guru->user->email}} " />
                                        @error('email')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">NIP</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value=" {{$guru->nip}} " />
                                        @error('nip')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Jabatan</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value=" {{$guru->jabatan}} " />
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">No HandPhone</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value=" {{$guru->nohp}} " />
                                        @error('nohp')
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
