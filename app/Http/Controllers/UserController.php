<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Biouser;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::join('roles', 'users.id_role', '=', 'roles.id')
        ->select('users.*', 'roles.rolename')
        ->where('id_role','=','4')
        ->orderBy('id', 'desc')->get();

        $bpom = User::join('roles', 'users.id_role', '=', 'roles.id')
        ->select('users.*', 'roles.rolename')
        ->whereIn('id_role',[2,3,5,6,7,8,9])
        ->orderBy('id_role', 'asc')->get();

        $admin = User::join('roles', 'users.id_role', '=', 'roles.id')
        ->select('users.*', 'roles.rolename')
        ->where('id_role','=','1')
        ->orderBy('id', 'asc')->get();

        return view('user.index', 
            [
                'user' => $user,
                'bpom' => $bpom,
                'admin'=> $admin
            ]
        )
        ->with('nouser',1)
        ->with('nobpom',1)
        ->with('noadmin',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $role = Role::whereIn('id',[2,3,4])->
        $role = Role::
        orderBy('id', 'asc')->get();

        return view('user.add', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->id_role = $request->id_role;
        $user->name    = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = true;
        $user->activation_token = '';

        $user->save();

        Alert::success('Success', 'Berhasil Menambah Data User!');

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $biouser = Biouser::join('users', 'biousers.id_user', '=', 'users.id')
        ->join('roles', 'users.id_role', '=', 'roles.id')
        ->select('users.name', 'users.username', 'users.email', 'biousers.*', 'roles.rolename')
        ->where('users.username',$id)->first();

        return view('user.detail', compact('biouser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::join('roles', 'users.id_role', '=', 'roles.id')
        ->select('users.*', 'roles.rolename')
        ->where('users.username',$id)->first();
        // $user = User::where('username','=',$id)->first();

        return view('user.edit', compact('user'));
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
        // $user = User::find($id);
        $user = User::where('username',$id)->first();

        $user->name    = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->id_role = $request->id_role;

        $user->update();

        Alert::success('Success', 'Berhasil Edit Data User!');

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id','=',$id);
        $user->delete();

        return redirect('user');
    }

    public function nonaktif($id)
    {
        $user = User::where('username',$id)->first();

        $user->active = '0';

        $user->update();

        Alert::success('Success', 'Berhasil Nonaktifkan User!');

        return redirect('user');
    }
}
