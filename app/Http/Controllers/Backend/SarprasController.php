<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SarprasController extends Controller
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
            $data = cache()->remember('sarpras', 5, function () {
                return Sarpras::all();
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
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-info edit-sarpras" data-toggle="modal" data-target="#editSarprasModal">
                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteSarprasModal" class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.v_sarpras');
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
        $sarpras = new Sarpras();
        $sarpras->nama = $request->nama;

        if ($request->hasFile('thumbnail_sarpras')) {
            $file = $request->file('thumbnail_sarpras');
            $filename = $file->store('sarpras', 'public');
            $path = asset('storage/' . $filename);
            $sarpras->thumbnail = $path;
        }

        $sarpras->save();
        return response()->json($sarpras);
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
        //
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
        $sarpras = Sarpras::find($id);
        $sarpras->nama = $request->nama;
        $sarpras->save();
        return response()->json($sarpras);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sarpras = Sarpras::find($id);
        if ($sarpras->thumbnail != null) {
            $file = explode('/', $sarpras->thumbnail);
            File::delete('storage/sarpras/' . end($file));
        };
        $sarpras->delete();
        return response()->json($sarpras);
    }

    public function updateThumbnail(Request $request, $id)
    {
        $filename = $request->file('thumb_sarpras')->store('sarpras', 'public');
        $path = asset('storage/' . $filename);

        $sarpras = Sarpras::find($id);
        if ($sarpras->thumbnail != null || $sarpras->thumbnail != '') {
            $file = explode('/', $sarpras->thumbnail);
            File::delete('storage/sarpras/' . end($file));
        }
        $sarpras->nama = $request->nama2;
        $sarpras->thumbnail = $path;
        $sarpras->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }
}