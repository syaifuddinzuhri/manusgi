<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SejarahController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'level']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sejarah = Sejarah::first();
            return response()->json($sejarah);
        }
        $sejarah = Sejarah::first();
        return view('backend.v_sejarah', compact('sejarah'));
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
        $sejarah = Sejarah::find($id);
        $sejarah->sejarah = $request->sejarah;
        $sejarah->save();
        return response()->json($sejarah);
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

    public function uploadImage(Request $request)
    {
        $filename = $request->file('image')->store('images', 'public');
        return response()->json([
            'imageUrl' => asset('storage/' . $filename)
        ]);
    }

    public function updateThumbnail(Request $request, $id)
    {
        $filename = $request->file('file')->store('images', 'public');
        $path = asset('storage/' . $filename);

        $sejarah = Sejarah::find($id);
        if ($sejarah->thumbnail != null || $sejarah->thumbnail != '') {
            $file = explode('/', $sejarah->thumbnail);
            File::delete('storage/images/' . end($file));
        }
        $sejarah->thumbnail = $path;
        $sejarah->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }

    public function deleteImage(Request $request)
    {
        unlink(public_path(('storage/images/' . $request->srcUrl)));
        return response()->json([
            'success' => 'File berhasil dihapus'
        ]);
    }

    public function deleteThumbnail($id)
    {
        $sejarah = Sejarah::find($id);
        $file = explode('/', $sejarah->thumbnail);
        File::delete('storage/images/' . end($file));
        $sejarah->thumbnail = '';
        $sejarah->save();
        return response()->json([
            'success' => 'Berhasil dihapus'
        ]);
    }
}