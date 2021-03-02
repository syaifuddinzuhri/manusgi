<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PublikasiController extends Controller
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

    /**
     * Berita Controller
     */
    public function berita()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $tag = Tag::all();
        $kategori = Kategori::all();
        $berita = Berita::with('user', 'kategori', 'tag')->latest()->paginate(5);
        return view('frontend.berita.v_berita', compact('app', 'recent_berita', 'berita', 'recent_prestasi', 'tag', 'kategori'));
    }

    public function detailBerita($slug)
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $berita = Berita::with('user', 'kategori', 'tag')->where('slug', '=', $slug)->first();
        if (!$berita) {
            abort(404);
        }
        return view('frontend.berita.v_detail_berita', compact('app', 'recent_berita', 'berita', 'recent_prestasi'));
    }

    public function cariBerita(Request $request)
    {
        $key = $request->keywords;
        $kategori = $request->kategori;
        $tag = $request->tag;

        if (isset($key)) {
            return $this->_beritaByKeyword($key);
        } else if (isset($kategori)) {
            return $this->_beritaByKategori($kategori);
        } else if (isset($tag)) {
            return $this->_beritaByTag($tag);
        }
        abort(404);
    }

    public function _beritaByKeyword($key)
    {
        $keyword = $key;
        $berita = Berita::whereHas('kategori', function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })->orWhereHas('tag', function ($query) use ($keyword) {
            $query->where('tag', 'like', '%' . $keyword . '%');
        })
            ->orWhere('judul', 'like', '%' . $keyword . '%')
            ->orWhere('isi', 'like', '%' . $keyword . '%')
            ->paginate(5);
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $tag = Tag::all();
        $kategori = Kategori::all();

        return view('frontend.berita.v_cariberita', compact('app', 'recent_berita', 'berita', 'kategori', 'tag', 'recent_prestasi', 'keyword'));
    }

    public function _beritaByKategori($kategori)
    {
        $keyword = $kategori;
        $berita = Berita::whereHas('kategori', function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })->paginate(5);

        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $tag = Tag::all();
        $kategori = Kategori::all();
        return view('frontend.berita.v_cariberita', compact('app', 'recent_berita', 'berita', 'kategori', 'tag', 'recent_prestasi', 'keyword'));
    }

    public function _beritaByTag($tag)
    {
        $keyword = $tag;
        $berita = Berita::whereHas('tag', function ($query) use ($keyword) {
            $query->where('tag', 'like', '%' . $keyword . '%');
        })->paginate(5);

        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $tag = Tag::all();
        $kategori = Kategori::all();
        return view('frontend.berita.v_cariberita', compact('app', 'recent_berita', 'berita', 'kategori', 'tag', 'recent_prestasi', 'keyword'));
    }

    /**
     * Pengumuman Controller
     */
    public function pengumuman()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $recent_pengumuman = $this->recent_pengumuman;
        $pengumuman = Pengumuman::with('user')->latest()->paginate(7);
        return view('frontend.pengumuman.v_pengumuman', compact('app', 'recent_berita', 'recent_pengumuman', 'pengumuman', 'recent_prestasi'));
    }

    public function cariPengumuman(Request $request)
    {
        $keyword = $request->keywords;
        $pengumuman = Pengumuman::Where('nama', 'like', '%' . $keyword . '%')
            ->orWhere('keterangan', 'like', '%' . $keyword . '%')
            ->paginate(5);

        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $recent_pengumuman = $this->recent_pengumuman;
        return view('frontend.pengumuman.v_caripengumuman', compact('app', 'recent_berita', 'recent_pengumuman', 'pengumuman', 'recent_prestasi', 'keyword'));
    }

    public function downloadFile($slug)
    {
        $pengumuman = Pengumuman::where('slug', '=', $slug)->first();
        $file = explode('/', $pengumuman->file);
        return response()->download('storage/pengumuman/' . end($file));
    }

    /**
     * Prestasi Controller
     */
    public function prestasi()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $prestasi = Prestasi::with('user')->latest()->paginate(5);
        return view('frontend.prestasi.v_prestasi', compact('app', 'recent_berita', 'prestasi', 'recent_prestasi'));
    }

    public function detailPrestasi($slug)
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $prestasi = Prestasi::with('user')->where('slug', '=', $slug)->first();
        if (!$prestasi) {
            abort(404);
        }
        return view('frontend.prestasi.v_detail_prestasi', compact('app', 'recent_berita', 'prestasi', 'recent_prestasi'));
    }

    public function cariPrestasi(Request $request)
    {
        $keyword = $request->keywords;
        $prestasi = Prestasi::Where('nama', 'like', '%' . $keyword . '%')
            ->orWhere('keterangan', 'like', '%' . $keyword . '%')
            ->paginate(5);

        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        return view('frontend.prestasi.v_cariprestasi', compact('app', 'recent_berita', 'prestasi', 'recent_prestasi', 'keyword'));
    }

    /**
     * ppdb Controller
     */
    public function ppdb()
    {
        $app = $this->app;
        $recent_berita = $this->recent_berita;
        $recent_prestasi = $this->recent_prestasi;
        $recent_pengumuman = $this->recent_pengumuman;
        return view('frontend.v_ppdb', compact('app', 'recent_berita', 'recent_pengumuman', 'recent_prestasi'));
    }
}