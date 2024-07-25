<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\MuridRequest;
use App\Models\Magang;
use App\Models\Murid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use ErrorException;
use Hash;
use DB;

class MuridController extends Controller
{
    public function index()
    {
        $murid = Murid::all();
        return view('backend.pages.murid.index', compact('murid'));
    }
    public function daftar()
    {
        return view('backend.pages.murid.pendaftaran');
    }

    public function create()
    {
        $murid= Murid::all();
        $user= User::all();
        return view('backend.pages.murid.create',compact('murid','user'));
    }
    public function store(SiswaRequest $request)
    {
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make('12345678'); // Enkripsi password
            $user->role     = 'siswa';
            $user->save(); // Simpan user
            
            if($user){
                $murid = new Murid;
                $murid->id          = $user->id;
                $murid->nama        = $user->name;
                $murid->nis         = $request->nis;
                $murid->jurusan     = $request->jurusan;
                $murid->kelas       = $request->kelas;
                $murid->save();
            }
            

            Session::flash('success','Data Murid Berhasil Ditambah !');
            return redirect()->route('murid.index');

        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function pendaftaran(MuridRequest $request)
    {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'siswa';
            $user->save();

            $murid = new Murid();
            $murid->id = $user->id;
            $murid->nama = $user->name;
            $murid->nis = $request->nis;
            $murid->jurusan = $request->jurusan;
            $murid->kelas = $request->kelas;
            $murid->save();

            // Tampilkan SweetAlert dengan informasi termasuk custom ID
            Alert::success('Pendaftaran Berhasil', 'Selamat Pendaftaran Anda Berhasil. Nomor pendaftaran Anda: ' . $murid->id);

            // Redirect or return view
            return redirect()->route('login');
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
        $murid = Murid::findOrFail($id);
        $user = User::findOrFail($murid->id);
    
        return view('backend.pages.murid.edit', compact('murid','user'));
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
            $murid = Murid::findOrFail($id);
            $user = User::findOrFail($murid->id);

            // Update data User
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->save();
            // Update other attributes
            $murid->nama        = $user->name;
            $murid->nis         = $request->nis;
            $murid->jurusan     = $request->jurusan;
            $murid->kelas       = $request->kelas;

            // Save the updated record
            $murid->update();

            Session::flash('success', 'Data Murid Berhasil Diupdate!');
            return redirect()->route('murid.index');
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
            $murid = Murid::findOrFail($id);
            
            // Delete record from the database
            $murid->delete();

            return redirect()->route('murid.index')->with('success', 'Data Murid Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->route('murid.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function infoMagangSiswa(){
        $siswa_id = Auth::id();
        $magangs = Magang::with(['mitra.guru', 'murid'])
                         ->where('id_siswa', $siswa_id)
                         ->get();
        return view('backend.pages.murid.informasi', compact('magangs'));
    }
}
