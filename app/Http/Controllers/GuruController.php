<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use ErrorException;
use Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('backend.pages.guru.index', compact('gurus'));
    }

    public function create()
    {
        $guru= Guru::all();
        return view('backend.pages.guru.create',compact('guru'));
    }
    public function store(GuruRequest $request)
    {
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make('12345678'); // Enkripsi password
            $user->role     = 'guru';
            $user->save(); // Simpan user
    
            // Pastikan user berhasil disimpan sebelum melanjutkan
            if ($user) {
                $guru = new Guru;
                $guru->id       = $user->id;
                $guru->nama     = $user->name;
                $guru->nip      = $request->nip;
                $guru->jabatan  = $request->jabatan;
                $guru->nohp     = $request->nohp;
                $guru->save(); // Simpan guru
            }    

            Session::flash('success','Data Guru Berhasil Ditambah !');
            return redirect()->route('guru.index');

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
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->id);
    
        return view('backend.pages.guru.edit', compact('guru', 'user'));
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
            $guru = Guru::findOrFail($id);
            $user = User::findOrFail($guru->id);

            // Update data User
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->save();

            // Update data Guru
            $guru->nama     = $user->name;
            $guru->nip      = $request->nip;
            $guru->jabatan  = $request->jabatan;
            $guru->nohp     = $request->nohp;
            $guru->save();

            Session::flash('success', 'Data Guru Berhasil Diupdate!');
            return redirect()->route('guru.index');
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
            // Cari data Guru berdasarkan ID
            $guru = Guru::findOrFail($id);

            // Cari data User berdasarkan ID Guru
            $user = User::findOrFail($guru->id);

            // Hapus data User
            $user->delete();

            // Hapus data Guru
            $guru->delete();

            return redirect()->route('guru.index')->with('success', 'Data Guru Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
