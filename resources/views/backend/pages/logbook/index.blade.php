@extends('layouts.app')

@section('content.wrapper')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LogBook</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">LogBook</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
        <div class="row">
            @if(!empty($magang))
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <!-- Optional: Add header content if needed -->
                        </div>
                        <div class="card-body">
                            <h5><strong>{{ $magang->mitra->nama }}</strong></h5>
                            <p class="text-muted" style="margin: 0; padding: 0;">
                                {{ \Carbon\Carbon::parse($magang->periode_awal)->translatedFormat('j F Y') }} - {{ \Carbon\Carbon::parse($magang->periode_akhir)->translatedFormat('j F Y') }}
                            </p>
                            <span class="text-success">
                                <i class="fas fa-circle fa-xs"></i> Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    @if (!$logbookExists)
                        <div class="card">
                            <div class="card-body">
                                <h5>Masukkan Periode Kegiatan Magang Kamu!</h5>
                                <p>Masukkan tanggal awal dan akhir kegiatan magang</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logbookModal">
                                    Tambah Logbook
                                </button>

                                <div class="modal fade" id="logbookModal" tabindex="-1" role="dialog" aria-labelledby="logbookModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="logbookModalLabel">Tambah Logbook Mingguan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('create-logbook') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="periode_awal">Periode Awal:</label>
                                                        <input type="date" class="form-control" id="periode_awal" name="periode_awal" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="periode_akhir">Periode Akhir:</label>
                                                        <input type="date" class="form-control" id="periode_akhir" name="periode_akhir" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $startOfMagang = \Carbon\Carbon::parse($magang->periode_awal);
                            $endOfMagang = \Carbon\Carbon::parse($magang->periode_akhir);
                        @endphp
                        @foreach ($logbooks as $key => $logbook)
                            <div class="card">
                                <div class="card-body">
                                    @if (is_null($logbook->catatan) || $logbook->catatan === '')
                                        <span class="text-danger">
                                            <i class="fas fa-file-alt"></i> Laporan Belum Dibuat
                                        </span>
                                    @else
                                        <span class="text-success">
                                            <i class="fas fa-check-circle"></i> Laporan Tersimpan
                                        </span>
                                    @endif
                                    <p style="margin: 0; padding: 0;"><strong> 
                                        @php
                                            $logbookDate = \Carbon\Carbon::parse($logbook->tanggal);
                                            $startOfWeek = $logbookDate->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                                            $endOfWeek = $logbookDate->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);

                                            if ($key == 0) {
                                                $startOfWeek = $startOfMagang;
                                            }
                                            if ($key == count($logbooks) - 1) {
                                                $endOfWeek = $endOfMagang;
                                            }

                                            $startOfWeekFormatted = $startOfWeek->format('j F Y');
                                            $endOfWeekFormatted = $endOfWeek->format('j F Y');
                                        @endphp
                                        {{ $startOfWeekFormatted }} - {{ $endOfWeekFormatted }}
                                    </strong></p>
                                    <p style="margin: 0; padding: 0;" class="text-secondary">Minggu Ke-{{$key+1}}</p>
                                    @if (is_null($logbook->catatan) || $logbook->catatan === '')
                                        <div class="text-center mt-5">
                                            <p class="text-muted">Kamu belum melengkapi laporan mingguan. Ayo ceritakan kegiatan magang kamu!</p>
                                            <a href="#" class="btn" data-toggle="modal" data-target="#editLogbookModal" data-id="{{ $logbook->id }}" data-catatan="{{ $logbook->catatan }}">
                                                <button class="btn btn-sm bg-primary border-0">
                                                    Buat Laporan Mingguan <i class="fas fa-circle-plus"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @else
                                        <div class="container mt-2">
                                            <p style="margin: 0; padding: 0;" class="text-secondary"><strong>Kegiatan apa yang kamu lakukan minggu ini?</strong></p>
                                            <p>{!! nl2br(e($logbook->catatan)) !!}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <!-- Optional: Add header content if needed -->
                        </div>
                        <div class="card-body">
                            <h5><strong>Kamu belum bisa melengkapi logbook</strong></h5>
                            <p class="text-secondary">
                                @if(empty($magang))
                                    Data magang mitra belum tersedia. Silahkan cek kembali nanti.
                                @else
                                    Logbook belum tersedia untuk magang ini.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>  
            @endif
        </div>

        <div class="modal fade" id="editLogbookModal" tabindex="-1" role="dialog" aria-labelledby="editLogbookModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLogbookModalLabel">Buat Laporan Mingguan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editLogbookForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="catatan">Apa yang kamu pelajari minggu ini?</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="5" placeholder="Tulis kegiatan magang kamu di sini..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Buat Laporan</button>
                            </div>                                 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
