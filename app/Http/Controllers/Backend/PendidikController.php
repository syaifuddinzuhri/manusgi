<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PendidikController extends Controller
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
                return Pendidik::all();
            });
            return DataTables::of($data)
                ->setRowAttr([
                    'id' => function ($data) {
                        return Str::random(10) . '$' . time() . '$' . $data->id;
                    },
                ])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/pendidik/' . $data->id . '/edit" class="btn btn-sm btn-info">
                        <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deletePendidikModal"class="btn btn-sm btn-danger delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $pendidik =  Pendidik::all();
        return view('backend.pendidik.v_pendidik', compact('pendidik'));
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
        $pendidik = new Pendidik();
        $pendidik->nama = $request->nama;
        $pendidik->email = $request->email;
        $pendidik->jabatan = $request->jabatan;
        $pendidik->telepon = $request->nohp;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->store('pendidik', 'public');
            $path = asset('storage/' . $filename);
            $pendidik->foto = $path;
        }

        $pendidik->save();
        return response()->json($pendidik);
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
        $pendidik = Pendidik::find($id);
        return view('backend.pendidik.v_edit', compact('pendidik'));
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
        $pendidik = Pendidik::find($id);
        $pendidik->nama = $request->nama;
        $pendidik->email = $request->email;
        $pendidik->jabatan = $request->jabatan;
        $pendidik->telepon = $request->nohp;
        $pendidik->save();
        return response()->json($pendidik);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idp = explode('$', $id);
        $pid = end($idp);
        $pendidik = Pendidik::find($pid);
        if ($pendidik->foto != null) {
            $foto = explode('/', $pendidik->foto);
            File::delete('storage/pendidik/' . end($foto));
        }
        $pendidik->delete();
        return response()->json($pendidik);
    }

    public function updateFoto(Request $request, $id)
    {
        $pendidik = Pendidik::find($id);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->store('pendidik', 'public');
            $path = asset('storage/' . $filename);

            if ($pendidik->foto != null || $pendidik->foto != '') {
                $file = explode('/', $pendidik->foto);
                File::delete('storage/pendidik/' . end($file));
            }
            $pendidik->foto = $path;
            $pendidik->save();
        } else {
            abort(505);
        }
        return response()->json($pendidik);
    }
}