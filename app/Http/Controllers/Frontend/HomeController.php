<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Berita;
use App\Models\Jurusan;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $app;
    protected $recent_berita;
    protected $recent_prestasi;
    protected $recent_pengumuman;

    public function __construct()
    {
        $this->app = Aplikasi::first();
        $this->recent_berita = Berita::with('user', 'kategori', 'tag')->latest()->limit(3)->get();
        $this->recent_prestasi = Prestasi::with('user')->latest()->limit(3)->get();
        $this->recent_pengumuman = Pengumuman::with('user')->latest()->limit(3)->get();
    }

    public function index()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $recent_pengumuman = $this->recent_pengumuman;
        $jurusan = Jurusan::all();
        return view('frontend.v_home', compact('app', 'jurusan', 'recent_berita', 'recent_pengumuman', 'recent_prestasi'));
    }
}