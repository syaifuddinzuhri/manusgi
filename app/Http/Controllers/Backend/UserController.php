<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
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
            $data = cache()->remember('users', 5, function () {
                return  User::orderBy('level', 'DESC')->get();
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
                    $button .= '<a href="/admin/user/' . Str::random(10) . '$' . time() . '$' . $data->id . '/edit" class="btn btn-sm btn-info">
                    <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteUserModal"class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.user.v_user');
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        cache()->forget('users');
        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        cache()->forget('users');
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ids = explode('$', $id);
        $sid = end($ids);
        $user = User::find($sid);
        return view('backend.user.v_edit', compact('user'));
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
        //
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
        User::find($sid)->delete();
        cache()->forget('users');
        return response()->json('success');
    }

    public function updateData(Request $request)
    {
        if ($request->level < 0 || $request->level > 1) {
            return response()->json('failed');
        }
        $user = User::find($request->id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->save();
        cache()->forget('users');
        return response()->json($user);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find($request->id);
        $user->id = $request->id;
        $user->password = Hash::make($request->password);
        $user->save();
        cache()->forget('users');
        return response()->json($user);
    }
}