<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagangRequest;
use App\Models\Magang;
use App\Models\Mitra;
use App\Models\Murid;
use Illuminate\Http\Request;
use Session;
use ErrorException;

class MagangController extends Controller
{
    public function index()
    {
        $magang = Magang::all();
        $murid = Murid::all();
        $mitra = Mitra::withCount('magangs')->get();
        return view('backend.pages.magang.index', compact('magang','murid','mitra'));
    }
    public function dataMagang()
    {
        $magang = Magang::all();
        $murid = Murid::all();
        $mitra = Mitra::withCount('magangs')->get();
        return view('backend.pages.magang.laporan', compact('magang','murid','mitra'));
    }

    public function create()
    {
        $magang= magang::all();
        $murids= murid::all();
        $mitras = Mitra::all();
        return view('backend.pages.magang.create',compact('magang','murids','mitras'));
    }
    public function store(MagangRequest $request)
    {
        try {
            $request->validate([
                'id_mitra' => 'required|exists:mitra,id',
                'periode_awal' => 'required|date',
                'periode_akhir' => 'required|date|after_or_equal:periode_awal',
                'id_siswa' => 'required',
                'id_siswa.*' => 'exists:murids,id',
            ]);
                
                Magang::create([
                    'id_mitra' => $request->id_mitra,
                    'id_siswa' => $request->id_siswa,
                    'periode_awal' => $request->periode_awal,
                    'periode_akhir' => $request->periode_akhir,
                    'is_active'=> '1',
                ]);
    
            return redirect()->route('magang.index')->with('success', 'Data magang berhasil disimpan.');

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
        $mitra = Mitra::with(['magangs.murid'])->findOrFail($id);
        return view('backend.pages.magang.show', compact('mitra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magang = magang::find($id);
        $siswa= murid::all();
        $mitra = Mitra::all();
        return view('backend.pages.magang.edit', compact('magang','siswa','mitra'));
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
            $magang = magang::find($id);
            // Update other attributes
            $magang->id_mitra            = $request->id_mitra;
            $magang->id_siswa            = $request->id_siswa;
            $magang->periode_awal        = $request->periode_awal;
            $magang->periode_akhir       = $request->periode_akhir;
            $magang->is_active           = 1;
            $magang->keterangan          = $request->keterangan;
            // Save the updated record
            $magang->update();

            Session::flash('success', 'Data Magang Berhasil Diupdate!');
            return redirect()->route('magang.index');
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
            $magang = Magang::findOrFail($id);
            
            // Delete record from the database
            $magang->delete();

            return redirect()->route('magang.index')->with('success', 'Data Magang Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->route('magang.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getmurid(Request $request)
    {
        $murid = murid::where('id_mitra', 'like', '%'.request('q').'%')->get();

        return response()->json($murid);
    }

    public function getMitra(Request $request)
    {
        $jurusan = $request->input('jurusan');
        $query = $request->input('q');

        $mitra = Mitra::when($jurusan, function ($query, $jurusan) {
            return $query->where('jurusan', $jurusan);
        })->when($query, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        })->get();

        return response()->json($mitra);
    }
    public function getSiswa(Request $request)
    {
        $searchQuery = $request->input('q'); // Parameter pencarian nama

        // Mendapatkan data murid yang memiliki status magang tidak aktif atau tidak ada di tabel magang
        $siswa = Murid::whereDoesntHave('magang')
            ->orWhereHas('magang', function ($query) {
                $query->where('is_active', 0); // Pastikan field is_active di tabel magang bernilai 0
            })
            ->when($searchQuery, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->get();

        return response()->json($siswa);
    }

    function kurangiKuotaMitra()
    {
        // Mengambil semua mitra
        $mitras = Mitra::all();

        foreach ($mitras as $mitra) {
            // Menghitung jumlah magang yang aktif untuk mitra tersebut
            $jumlahMagangAktif = Magang::where('id_mitra', $mitra->id)
                                    ->where('is_active', 1)
                                    ->count();

            // Mengurangi kuota mitra dengan jumlah magang yang aktif
            $mitra->kuota -= $jumlahMagangAktif;
            $mitra->save();
        }
    }

    public function createFromMitra($id = null)
    {
        $mitra = null;
        if ($id) {
            $mitra = Mitra::find($id);
            if ($mitra && $mitra->kuota <= 0) {
                return redirect()->route('magang.index', $id)->with('error', 'Kuota magang untuk mitra ini sudah habis.');
            }
        }
        return view('backend.pages.magang.create', compact('mitra'));
    }
}
