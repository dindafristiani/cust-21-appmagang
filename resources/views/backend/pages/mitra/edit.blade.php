@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Mitra</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mitra.index') }}">
                            Data Mitra
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Data Mitra</li>
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
                    <form method="post" action="{{ route('mitra.update', $mitra->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Mitra</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value=" {{$mitra->nama}} " />
                                        @error('nama')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Alamat</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value=" {{$mitra->alamat}} " />
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">PIC</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('pic') is-invalid @enderror" name="pic" value=" {{$mitra->pic}} " />
                                        @error('pic')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">No HandPhone</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value=" {{$mitra->nohp}} " />
                                        @error('nohp')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <label for="basicInput">Guru Pendamping</label> <span class="text-danger">*</span>
                                        <select class="form-control @error('id_guru') is-invalid @enderror" name="id_guru" style="width: 100%;" id="js-example-basic-single">
                                            <option value="">Pilih Guru Pendamping</option>
                                            @foreach($guru as $guru_item)
                                                <option value="{{ $guru_item->id }}" {{ $guru_item->id == $mitra->id_guru ? 'selected' : '' }}>
                                                    {{ $guru_item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_guru')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Kuota</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('kuota') is-invalid @enderror" name="kuota" value=" {{$mitra->kuota}} " />
                                        @error('kuota')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div> -->
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
