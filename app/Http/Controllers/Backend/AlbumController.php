<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AlbumController extends Controller
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
            $data = cache()->remember('album', 5, function () {
                return Album::with('galeri')->get();
            });
            return DataTables::of($data)
                ->setRowAttr([
                    'id' => function ($data) {
                        return $data->id;
                    },
                ])
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('jumlah', function ($data) {
                    return $data->galeri->count() . " foto";
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/album/' . $data->id . '/edit" class="btn btn-sm btn-info">
                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteAlbumModal" class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'created_at', 'nama', 'jumlah'])
                ->make(true);
        }
        $album = Album::with('galeri')->get();
        return view('backend.album.v_album', compact('album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new Album();
        $album->nama = $request->album;
        $album->slug = Str::slug($request->album);
        $album->save();
        return response()->json($album);
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
        $album = Album::with('galeri')->where('id', '=', $id)->first();
        return view('backend.album.v_edit', compact('album'));
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
        $album = Album::find($id);
        $album->nama = $request->nama;
        $album->slug = Str::slug($request->nama);
        $album->save();
        return response()->json($album);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $path = 'storage/album/' . $album->slug;
        foreach ($album->galeri as $value) {
            $file = explode('/', $value->gambar);
            File::delete($path . '/' . end($file));
        }
        File::deleteDirectory($path);
        $album->delete();
        return response()->json($album);
    }

    public function uploadImage(Request $request)
    {
        $idalbum = $request->iddz;
        $album = Album::find($idalbum);

        $file = $request->file('file');
        $filename = $file->store('album/' . $album->slug . '', 'public');
        $path = asset('storage/' . $filename);

        $galeri = new Galeri();
        $galeri->gambar = $path;
        $galeri->album_id = $idalbum;
        $galeri->save();

        return response()->json([
            'imageUrl' => asset('storage/' . $filename)
        ]);
    }

    public function deleteGambar($id)
    {
        $galeri = Galeri::find($id);
        $file = explode('/', $galeri->gambar);
        $path = 'storage/album/' . $galeri->album->slug;
        File::delete($path . '/' . end($file));
        $galeri->delete();
        return response()->json('success');
    }

    public function showGaleri($id)
    {
        $album = Album::with('galeri')->where('id', '=', $id)->first();
        $html = '';
        foreach ($album->galeri as $gal) {
            $html .= '<div class="col-md-3 col-6 my-2 text-center">';
            $html .= '<img src="' . $gal->gambar . '" class="img-responsive img-thumbnail" alt="Gambar">';
            $html .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteGambarModal"  data-id="' . $gal->id . '" class="btn btn-sm btn-danger delete-gambar">
            <i class="fa fa-trash" aria-hidden="true"></i></a>';
            // $html .= '<button type="button" class="btn btn-sm btn-danger mt-2 delete-gambar" id="' . $gal->id . '">Hapus</button>';
            $html .= '</div>';
        }
        return response()->json($html);
    }
}