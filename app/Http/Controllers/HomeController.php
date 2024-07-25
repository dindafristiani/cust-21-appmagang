<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Magang;
use App\Models\Mitra;
use App\Models\Murid;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahMitra = Mitra::count();
        $jumlahGuru = Guru::count();
        $jumlahMurid = Murid::count();
        $jumlahMagangAktif = Magang::where('is_active', true)->count();
        return view('backend.dashboard', compact('jumlahMitra','jumlahGuru','jumlahMurid','jumlahMagangAktif'));
    }
}
