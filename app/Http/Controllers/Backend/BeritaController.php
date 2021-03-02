<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PDF;

class BeritaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = cache()->remember('users', 5, function () {
                return Berita::with('user', 'kategori', 'tag')->get();
            });
            return DataTables::of($data)
                ->setRowAttr([
                    'id' => function ($data) {
                        return Str::random(10) . '$' . time() . '$' . $data->id;
                    },
                ])
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('publisher', function ($data) {
                    return $data->user->name;
                })
                ->editColumn('kategori', function ($data) {
                    return optional($data->kategori)->nama;
                })
                ->editColumn('tag', function ($data) {
                    $tags = '';
                    foreach ($data->tag as $tag) {
                        $tags .= '<span class="badge badge-dark mx-1">' . $tag->tag . '</span>';
                    }
                    return $tags;
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/berita/' . $data->id . '/edit" class="btn btn-sm btn-info">
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteBeritaModal"class="btn btn-sm btn-danger delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'publisher', 'kategori', 'tag', 'created_at'])
                ->make(true);
        }
        $berita = Berita::with('user', 'kategori', 'tag')->get();
        return view('backend.berita.v_berita', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::all();
        $kategori = Kategori::all();
        return view('backend.berita.v_create', compact('tag', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->hasFile('file')) {
            $filename = $request->file('file')->store('berita', 'public');
            $path = asset('storage/' . $filename);
        }

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->isi = $request->isiberita;
        $berita->thumbnail = $path;
        $berita->user_id = $id;
        $berita->kategori_id = $request->kategori;
        $berita->save();

        if ($request->tags) {
            $tags = explode(',', $request->tags);
            $tagIds = [];
            foreach ($tags as $tag) {
                $tagIds[] = $tag;
            }
            $berita->tag()->attach($tagIds);
        }
        return response()->json($berita);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json('ok');
    }

    public function getTags($id)
    {
        $berita = Berita::find($id);
        $tags = [];
        foreach ($berita->tag as $t) {
            $tags[] = $t->pivot->tag_id;
        }
        return response()->json($tags);
    }


    public function edit($id)
    {
        $berita = Berita::find($id);
        $tag = Tag::all();
        $kategori = Kategori::all();
        if (empty($berita)) {
            return abort(404);
        }
        return view('backend.berita.v_edit', compact('berita', 'tag', 'kategori'));
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
        $berita = Berita::find($id);
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->isi = $request->isi;
        $berita->kategori_id = $request->kategori;
        $berita->save();
        return response()->json($berita);
    }

    public function updateTags(Request $request, $id)
    {
        $berita = Berita::find($id);
        if ($request->tags) {
            $berita->tag()->sync($request->tags);
        } else {
            $tags = [];
            foreach ($berita->tag as $t) {
                $tags[] = $t->pivot->tag_id;
            }
            $berita->tag()->detach($tags);
        }
        return response()->json($request->tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode('$', $id);
        $sid = end($ids);
        $berita = Berita::find($sid);
        $tags = [];
        foreach ($berita->tag as $t) {
            $tags[] = $t->pivot->tag_id;
        }
        $berita->tag()->detach($tags);
        $berita->delete();
        return response()->json('success');
    }

    public function uploadImage(Request $request)
    {
        $filename = $request->file('image')->store('berita', 'public');
        return response()->json([
            'imageUrl' => asset('storage/' . $filename)
        ]);
    }

    public function updateThumbnail(Request $request, $id)
    {
        $filename = $request->file('thumb-berita')->store('berita', 'public');
        $path = asset('storage/' . $filename);

        $berita = Berita::find($id);
        if ($berita->thumbnail != null || $berita->thumbnail != '') {
            $file = explode('/', $berita->thumbnail);
            File::delete('storage/berita/' . end($file));
        }
        $berita->thumbnail = $path;
        $berita->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }

    public function deleteImage(Request $request)
    {
        unlink(public_path(('storage/berita/' . $request->srcUrl)));
        return response()->json([
            'success' => 'File berhasil dihapus'
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->judul);
        return response()->json(['slug' => $slug]);
    }

    public function printPDF()
    {
        // $berita = Berita::first();
        // $data = [
        //     'judul' => $berita->judul,
        //     'isi' => $berita->isi,
        //     'user' => $berita->user->name,
        //     'datetime' => $berita->created_at->format('d-m-Y H:i:s'),
        //     'kategori' => $berita->kategori->nama,
        //     'thumbnail' => $berita->thumbnail,
        // ];
        // $pdf = PDF::loadView('berita', $data);
        // return $pdf->download($berita->judul . '.pdf');
        // return view('berita', compact('berita'));
    }
}