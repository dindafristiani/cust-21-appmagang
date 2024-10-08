<?php

namespace App\Http\Controllers;

use App\Http\Requests\MitraRequest;
use App\Models\Guru;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use ErrorException;
use Hash;

class MitraController extends Controller
{
    public function index()
    {
        $mitra = Mitra::all();
        $guru = Guru::all();
        return view('backend.pages.mitra.index', compact('mitra','guru'));
    }

    public function create()
    {
        $mitra= Mitra::all();
        $guru= Guru::all();
        return view('backend.pages.mitra.create',compact('mitra','guru'));
    }
    public function store(MitraRequest $request)
    {
        try {

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make('12345678'); // Enkripsi password
            $user->role     = 'mitra';
            $user->save(); // Simpan user
    
            // Pastikan user berhasil disimpan sebelum melanjutkan
            if ($user) {
            $mitra = new Mitra;
            $mitra->id              = $user->id;
            $mitra->nama            = $user->name;
            $mitra->alamat          = $request->alamat;
            $mitra->pic             = $request->pic;
            $mitra->nohp            = $request->nohp;
            $mitra->jurusan         = $request->jurusan;
            $mitra->save();
            }

            Session::flash('success','Data Mitra Berhasil Ditambah !');
            return redirect()->route('mitra.index');

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
        $mitra = mitra::find($id);
        $guru = Guru::all();
        return view('backend.pages.mitra.edit', compact('mitra','guru'));
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
            $mitra = mitra::find($id);
            // Update other attributes
            $mitra->nama            = $request->nama;
            $mitra->alamat          = $request->alamat;
            $mitra->pic             = $request->pic;
            $mitra->nohp            = $request->nohp;
            $mitra->jurusan         = $request->jurusan;
            // Save the updated record
            $mitra->update();

            Session::flash('success', 'Data Mitra Berhasil Diupdate!');
            return redirect()->route('mitra.index');
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
            $mitra = mitra::findOrFail($id);
            $user = $mitra->user;

            if ($user) {
                $user->delete();
            }

            $mitra->delete();

            return redirect()->route('mitra.index')->with('success', 'Data Mitra Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->route('mitra.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getGuru(Request $request)
    {
        $guru = Guru::where('nama', 'like', '%'.request('q').'%')->get();

        return response()->json($guru);
    }

}
