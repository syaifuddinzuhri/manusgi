<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
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
                return Pengumuman::with('user')->get();
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
                    $button .= '<a href="/admin/pengumuman/' . $data->id . '/edit" class="btn btn-sm btn-info edit-pengumuman" >
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deletePengumumanModal"class="btn btn-sm btn-danger delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $data->file != null ?
                        $button .= '<a href="/admin/pengumuman/download/' . $data->id . '" class="btn btn-sm btn-success">
                                                <i class="fa fa-download" aria-hidden="true"></i></a>' : null;
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'publisher', 'created_at'])
                ->make(true);
        }
        $pengumuman = Pengumuman::with('user')->get();
        return view('backend.pengumuman.v_pengumuman', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengumuman.v_create');
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
        $pengumuman = new Pengumuman();
        $pengumuman->nama = $request->nama;
        $pengumuman->slug = Str::slug($request->nama);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->store('pengumuman', 'public');
            $path = asset('storage/' . $filename);
            $pengumuman->file = $path;
        }

        if ($request->ket_pengumuman) {
            $pengumuman->keterangan = $request->ket_pengumuman;
        }
        $pengumuman->user_id = $uid;
        $pengumuman->save();
        return response()->json($pengumuman);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);
        return response()->json($pengumuman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);
        return view('backend.pengumuman.v_edit', compact('pengumuman'));
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
        $pengumuman = Pengumuman::find($id);
        if ($request->keterangan) {
            $pengumuman->keterangan = $request->keterangan;
        }

        $pengumuman->nama = $request->nama;
        $pengumuman->slug = Str::slug($request->nama);
        $pengumuman->save();
        return response()->json($request->all());
    }

    public function updateFile(Request $request, $id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($request->hasFile('file2')) {
            if ($pengumuman->file != null) {
                $file = explode('/', $pengumuman->file);
                File::delete('storage/pengumuman/' . end($file));
            }
            $file = $request->file('file2');
            $filename = $file->store('pengumuman', 'public');
            $path = asset('storage/' . $filename);
            $pengumuman->file = $path;
        }

        if ($request->ket_pengumuman2) {
            $pengumuman->keterangan = $request->ket_pengumuman2;
        }

        $pengumuman->nama = $request->nama2;
        $pengumuman->slug = Str::slug($request->nama2);
        $pengumuman->save();
        return response()->json($request->all());
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
        $pengumuman = Pengumuman::find($sid);
        if ($pengumuman->file != null) {
            $file = explode('/', $pengumuman->file);
            File::delete('storage/pengumuman/' . end($file));
        }
        $pengumuman->delete();
        return response()->json($pengumuman);
    }

    public function downloadFile($id)
    {
        $pengumuman = Pengumuman::find($id);
        $file = explode('/', $pengumuman->file);
        return response()->download('storage/pengumuman/' . end($file));
    }


    public function uploadImage(Request $request)
    {
        $filename = $request->file('image')->store('pengumuman', 'public');
        return response()->json([
            'imageUrl' => asset('storage/' . $filename)
        ]);
    }

    public function deleteImage(Request $request)
    {
        unlink(public_path(('storage/pengumuman/' . $request->srcUrl)));
        return response()->json([
            'success' => 'File berhasil dihapus'
        ]);
    }
}