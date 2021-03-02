<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
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
            $data = cache()->remember('jurusan', 5, function () {
                return Jurusan::all();
            });
            return DataTables::of($data)
                ->setRowAttr([
                    'id' => function ($data) {
                        return $data->id;
                    },
                ])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-info edit-jurusan" data-toggle="modal" data-target="#editJurusanModal">
                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteJurusanModal" class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.v_jurusan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jurusan = new Jurusan();
        $jurusan->nama = $request->nama;
        $jurusan->icon = $request->icon;

        if ($request->hasFile('thumbnail_jurusan')) {
            $file = $request->file('thumbnail_jurusan');
            $filename = $file->store('jurusan', 'public');
            $path = asset('storage/' . $filename);
            $jurusan->thumbnail = $path;
        }

        $jurusan->save();
        return response()->json($jurusan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = Jurusan::find($id);
        return response()->json($jurusan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $jurusan = Jurusan::find($id);
        $jurusan->nama = $request->nama;
        $jurusan->icon = $request->icon;
        $jurusan->save();
        return response()->json($jurusan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        if ($jurusan->thumbnail != null) {
            $file = explode('/', $jurusan->thumbnail);
            File::delete('storage/jurusan/' . end($file));
        };
        $jurusan->delete();
        return response()->json($jurusan);
    }

    public function updateThumbnail(Request $request, $id)
    {
        $filename = $request->file('thumb_jurusan')->store('jurusan', 'public');
        $path = asset('storage/' . $filename);

        $jurusan = Jurusan::find($id);
        if ($jurusan->thumbnail != null || $jurusan->thumbnail != '') {
            $file = explode('/', $jurusan->thumbnail);
            File::delete('storage/jurusan/' . end($file));
        }
        $jurusan->nama = $request->nama2;
        $jurusan->icon = $request->icon2;
        $jurusan->thumbnail = $path;
        $jurusan->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }
}