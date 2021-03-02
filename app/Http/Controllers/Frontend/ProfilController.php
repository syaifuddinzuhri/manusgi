<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Aplikasi;
use App\Models\Berita;
use App\Models\Jurusan;
use App\Models\Pendidik;
use App\Models\Prestasi;
use App\Models\Sarpras;
use App\Models\Sejarah;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class ProfilController extends Controller
{

    protected $app;
    protected $recent_berita;
    protected $recent_prestasi;

    public function __construct()
    {
        $this->app = Aplikasi::first();
        $this->recent_berita = Berita::with('user', 'kategori', 'tag')->latest()->limit(3)->get();
        $this->recent_prestasi = Prestasi::with('user')->latest()->limit(3)->get();
    }

    /**
     * Sejarah Controller
     */

    public function sejarah()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $sejarah = Sejarah::first();
        $app = $this->app;
        return view('frontend.v_sejarah', compact('app', 'sejarah', 'recent_berita', 'recent_prestasi'));
    }

    /**
     * Visi Misi Controller
     */

    public function visiMisi()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $visimisi = VisiMisi::first();
        $app = $this->app;
        return view('frontend.v_visimisi', compact('app', 'visimisi', 'recent_berita', 'recent_prestasi'));
    }

    /**
     * Sarana Prasarana Controller
     */

    public function sarpras()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $sarpras = Sarpras::all();
        return view('frontend.v_sarpras', compact('app', 'sarpras', 'recent_berita', 'recent_prestasi'));
    }

    /**
     * Pendidik Controller
     */

    public function pendidik()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $pendidik = Pendidik::all();
        return view('frontend.v_pendidik', compact('app', 'pendidik', 'recent_berita', 'recent_prestasi'));
    }

    /**
     * Jurusan Controller
     */

    public function jurusan()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $jurusan = Jurusan::all();
        return view('frontend.v_jurusan', compact('app', 'jurusan', 'recent_berita', 'recent_prestasi'));
    }

    /**
     * Galeri Controller
     */

    public function galeri()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $album = Album::with('galeri')->get();
        return view('frontend.v_galeri', compact('app', 'album', 'recent_berita', 'recent_prestasi'));
    }
}