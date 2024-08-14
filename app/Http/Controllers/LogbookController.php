<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Magang;
use App\Models\Murid;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use ErrorException;

class LogbookController extends Controller
{
    public function index()
    {
        $idSiswa = Auth::id();
        $logbooks = Logbook::where('id_siswa', $idSiswa)->orderBy('tanggal')->get();
        $magang = Magang::where('id_siswa', $idSiswa)->first();
        // Set locale Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');
        $logbookExists = false;
        // Cek apakah id_siswa dan id_magang sudah ada di logbook
        if ($magang) {
            $logbookExists = Logbook::where('id_siswa', $idSiswa)
                                    ->where('id_magang', $magang->id)
                                    ->exists();
        }

        return view('backend.pages.logbook.index', compact('logbooks', 'logbookExists','magang'));
    }


    public function create()
    {
        $logbook= logbook::all();
        return view('backend.pages.logbook.create',compact('logbook'));
    }
    public function store(logbookRequest $request)
    {
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make('12345678'); // Enkripsi password
            $user->role     = 'logbook';
            $user->save(); // Simpan user
    
            // Pastikan user berhasil disimpan sebelum melanjutkan
            if ($user) {
                $logbook = new logbook;
                $logbook->id       = $user->id;
                $logbook->nama     = $user->name;
                $logbook->nip      = $request->nip;
                $logbook->jabatan  = $request->jabatan;
                $logbook->nohp     = $request->nohp;
                $logbook->save(); // Simpan logbook
            }    

            Session::flash('success','Data logbook Berhasil Ditambah !');
            return redirect()->route('logbook.index');

        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logbook = Logbook::findOrFail($id);
        return view('backend.pages.logbook.index', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'catatan' => 'required|string',
            ]);
    
            $logbook = Logbook::findOrFail($id);
            $logbook->update([
                'catatan' => $request->catatan,
            ]);

            Session::flash('success', 'Terima Kasih! Laporan mingguan kamu telah tersimpan.');
            return redirect()->route('logbook-siswa.index');
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Cari data logbook berdasarkan ID
            $logbook = logbook::findOrFail($id);

            // Cari data User berdasarkan ID logbook
            $user = User::findOrFail($logbook->id);

            // Hapus data User
            $user->delete();

            // Hapus data logbook
            $logbook->delete();

            return redirect()->route('logbook.index')->with('success', 'Data logbook Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->route('logbook.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function createWeeklyLogbooks(Request $request)
    {
        try {
            $request->validate([
                'periode_awal' => 'required|date',
                'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            ]);
    
            $idSiswa = Auth::id();
            $periodeAwal = Carbon::parse($request->periode_awal);
            $periodeAkhir = Carbon::parse($request->periode_akhir);
    
            // Cari data magang berdasarkan id siswa dan status is_active = 1
            $magang = Magang::where('id_siswa', $idSiswa)->where('is_active', 1)->firstOrFail();
    
            // Start date adjustment
            $startDate = $periodeAwal;
    
            // Loop through each week and create logbook entries for the last day of each week
            while ($startDate->lessThanOrEqualTo($periodeAkhir)) {
                $endOfWeek = $startDate->copy()->endOfWeek()->subDay(); // Set end of week to Saturday
    
                // Ensure endOfWeek does not go beyond the actual end date
                if ($endOfWeek->gt($periodeAkhir)) {
                    $endOfWeek = $periodeAkhir;
                }
    
                // Only log the last day of each week
                Logbook::create([
                    'id_magang' => $magang->id,
                    'id_siswa' => $idSiswa,
                    'tanggal' => $endOfWeek->toDateString(),
                    'catatan' => null
                ]);
    
                // Move to the next Monday
                $startDate->addWeek();
            }
    
            Session::flash('success', 'Logbook berhasil dibuat! Silahkan lengkapi sesuai jadwal');
            return redirect()->route('logbook-siswa.index');
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    


    public function showLogbookSiswa($id_siswa)
    {
        $logbooks = Logbook::where('id_siswa', $id_siswa)->get();
        $siswa = Murid::findOrFail($id_siswa);
        $magang = Magang::where('id_siswa', $id_siswa)->first();
        // Set locale Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');
        return view('backend.pages.logbook.show', compact('logbooks', 'siswa', 'magang'));
    }
}
