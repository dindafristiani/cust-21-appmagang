@extends('layouts.app')

@section('content.wrapper')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LogBook</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">LogBook</li>
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
                <div class="col-12">
                    <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="col-2"><strong>Nama Siswa</strong></td>
                                    <td>: {{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIS</strong></td>
                                    <td>: {{ $siswa->nis}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td>: {{ $siswa->kelas }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan</strong></td>
                                    <td>: {{ $siswa->jurusan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Periode</strong></td>
                                    <td>: {{ \Carbon\Carbon::parse($magang->periode_awal)->translatedFormat('j F Y') }} - {{ \Carbon\Carbon::parse($magang->periode_akhir)->translatedFormat('j F Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Laporan Mingguan</th>
                                <th>Catatan Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $startOfMagang = \Carbon\Carbon::parse($magang->periode_awal);
                                $endOfMagang = \Carbon\Carbon::parse($magang->periode_akhir);
                            @endphp
                            @foreach ($logbooks as $key => $logbook)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> @php
                                        // Mengambil tanggal dari logbook
                                        $logbookDate = \Carbon\Carbon::parse($logbook->tanggal);
                                        // Menentukan tanggal awal minggu (Senin) dan akhir minggu (Sabtu) dari tanggal logbook
                                        $startOfWeek = $logbookDate->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                                        $endOfWeek = $logbookDate->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);

                                        // Pastikan tanggal awal dan akhir minggu sesuai dengan periode magang
                                        if ($key == 0) {
                                            // Minggu pertama
                                            $startOfWeek = $startOfMagang;
                                        }
                                        if ($key == count($logbooks) - 1) {
                                            // Minggu terakhir
                                            $endOfWeek = $endOfMagang;
                                        }

                                        // Format tanggal
                                        $startOfWeekFormatted = $startOfWeek->translatedFormat('j F Y');
                                        $endOfWeekFormatted = $endOfWeek->translatedFormat('j F Y');
                                    @endphp
                                    {{ $startOfWeekFormatted }} - {{ $endOfWeekFormatted }} </td>
                                <td> {!! nl2br(e($logbook->catatan)) !!} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>     
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@push('b-script')
<script>
        $('#editLogbookModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var catatan = button.data('catatan');
            
            var modal = $(this);
            modal.find('.modal-body #catatan').val(catatan);
            $('#editLogbookForm').attr('action', '/dashboard/logbook-siswa/update/' + id);
        });
    </script>
@endpush