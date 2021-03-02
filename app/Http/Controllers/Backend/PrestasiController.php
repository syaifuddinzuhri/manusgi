<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PrestasiController extends Controller
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
                return Prestasi::with('user')->get();
            });
            return DataTables::of($data)
                ->setRowAttr([
                    'id' => function ($data) {
                        return Str::random(10) . '$' . time() . '$' . $data->id;
                    },
                ])
                ->addIndexColumn()
                ->editColumn('publisher', function ($data) {
                    return $data->user->name;
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/prestasi/' . $data->id . '/edit" class="btn btn-sm btn-info">
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deletePrestasiModal"class="btn btn-sm btn-danger delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'publisher', 'created_at'])
                ->make(true);
        }
        $prestasi = Prestasi::with('user')->get();
        return view('backend.prestasi.v_prestasi', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.prestasi.v_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uid = Auth::user()->id;
        $prestasi = new Prestasi();
        $prestasi->nama = $request->nama;
        $prestasi->slug = Str::slug($request->nama);

        if ($request->hasFile('thumbnail_prestasi')) {
            $file = $request->file('thumbnail_prestasi');
            $filename = $file->store('prestasi', 'public');
            $path = asset('storage/' . $filename);
            $prestasi->thumbnail = $path;
        }

        if ($request->keterangan) {
            $prestasi->keterangan = $request->keterangan;
        }
        $prestasi->user_id = $uid;
        $prestasi->save();
        return response()->json($prestasi);
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
        $prestasi = Prestasi::find($id);
        return view('backend.prestasi.v_edit', compact('prestasi'));
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
        $prestasi = Prestasi::find($id);
        $prestasi->nama = $request->nama;
        $prestasi->slug = Str::slug($request->nama);

        if ($request->keterangan) {
            $prestasi->keterangan = $request->keterangan;
        }
        $prestasi->save();
        return response()->json($prestasi);
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
        $prestasi = Prestasi::find($sid);
        if ($prestasi->file != null) {
            $file = explode('/', $prestasi->file);
            File::delete('storage/prestasi/' . end($file));
        }
        $prestasi->delete();
        return response()->json($prestasi);
    }

    public function uploadImage(Request $request)
    {
        $filename = $request->file('image')->store('prestasi', 'public');
        return response()->json([
            'imageUrl' => asset('storage/' . $filename)
        ]);
    }

    public function updateThumbnail(Request $request, $id)
    {
        $filename = $request->file('thumb_prestasi')->store('prestasi', 'public');
        $path = asset('storage/' . $filename);

        $prestasi = Prestasi::find($id);
        if ($prestasi->thumbnail != null || $prestasi->thumbnail != '') {
            $file = explode('/', $prestasi->thumbnail);
            File::delete('storage/prestasi/' . end($file));
        }
        $prestasi->thumbnail = $path;
        $prestasi->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }

    public function deleteImage(Request $request)
    {
        unlink(public_path(('storage/prestasi/' . $request->srcUrl)));
        return response()->json([
            'success' => 'File berhasil dihapus'
        ]);
    }
}