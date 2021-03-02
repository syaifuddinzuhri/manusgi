<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AplikasiController extends Controller
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
    public function index()
    {
        $aplikasi = Aplikasi::first();
        return view('backend.v_aplikasi', compact('aplikasi'));
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
        //
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
        $aplikasi = Aplikasi::find($id);
        $aplikasi->nama = $request->nama;
        $aplikasi->alamat = $request->alamat;
        $aplikasi->email = $request->email;
        $aplikasi->telepon = $request->telepon;
        $aplikasi->meta_deskripsi = $request->deskripsi;
        $aplikasi->meta_keyword = $request->keyword;
        $aplikasi->save();
        return response()->json($aplikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateLogo(Request $request, $id)
    {
        $filename = $request->file('file_logo')->store('aplikasi', 'public');
        $path = asset('storage/' . $filename);

        $aplikasi = Aplikasi::find($id);
        if ($aplikasi->logo != null || $aplikasi->logo != '') {
            $file = explode('/', $aplikasi->logo);
            File::delete('storage/aplikasi/' . end($file));
        }
        $aplikasi->logo = $path;
        $aplikasi->save();
        return response()->json([
            'logo' => $path
        ]);
    }

    public function updateSosmed(Request $request, $id)
    {
        $aplikasi = Aplikasi::find($id);
        $aplikasi->facebook = $request->facebook;
        $aplikasi->instagram = $request->instagram;
        $aplikasi->twitter = $request->twitter;
        $aplikasi->youtube = $request->youtube;
        $aplikasi->save();
        return response()->json($aplikasi);
    }
}