<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'level']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $visimisi = VisiMisi::first();
            return response()->json($visimisi);
        }
        $visimisi = Visimisi::first();
        return view('backend.v_visimisi', compact('visimisi'));
    }

    public function update(Request $request, $id)
    {
        $visimisi = VisiMisi::find($id);
        $visimisi->visi = $request->visi;
        $visimisi->misi = $request->misi;
        $visimisi->save();
        return response()->json($visimisi);
    }


    public function updateThumbnail(Request $request)
    {
        $id = $request->input('id_visimisi2');
        $filename = $request->file('file')->store('images', 'public');
        $path = asset('storage/' . $filename);

        $visimisi = VisiMisi::find($id);
        if ($visimisi->thumbnail != null || $visimisi->thumbnail != "") {
            $file = explode('/', $visimisi->thumbnail);
            File::delete('storage/images/' . end($file));
        }
        $visimisi->thumbnail = $path;
        $visimisi->save();
        return response()->json([
            'thumbnail' => $path
        ]);
    }

    public function deleteThumbnail($id)
    {
        $visimisi = VisiMisi::find($id);
        $file = explode('/', $visimisi->thumbnail);
        File::delete('storage/images/' . end($file));
        $visimisi->thumbnail = '';
        $visimisi->save();
        return response()->json([
            'success' => 'Berhasil dihapus'
        ]);
    }
}