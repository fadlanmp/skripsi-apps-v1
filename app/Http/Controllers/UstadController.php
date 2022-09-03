<?php

namespace App\Http\Controllers;

use App\Models\Ustad;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;


class UstadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ustads.index', [
            'ustads' => Ustad::all()
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ustads.create',[
            'roles' => Role::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedDataUser = $request->validate([
            'name' => 'required|max:55',
            'username' => 'required|min:5|max:55|unique:users',
            // 'password' => 'required|min:8|max:12',
        ]);
        $validatedDataUser['role_id'] = 2;

        $validatedDataUser['password'] = 12345;
        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
        User::create($validatedDataUser);

        $validatedDataUstad = $request->validate([
            'name' => 'required|max:55',
            'jk' => 'required',
            'no_kontak' => 'min:11|max:20|unique:ustads'
        ]);
        $validatedDataUstad['user_id'] = User::all()->pluck('id')->last();
        Ustad::create($validatedDataUstad);

        return redirect('/dashboard/ustads')->with('success', 'New post has been added!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function show(Ustad $ustad)
    {
        return view('dashboard.ustads.show',[
            'ustad' => $ustad
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ustad $ustad)
    {
        return view('dashboard.ustads.edit',[
            'ustad' => $ustad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ustad $ustad)
    {
        $rulesUstad = [
            'name' => 'required|max:55',
            'jk' => 'required'
        ];

        if($request->no_kontak != $ustad->no_kontak){
            $rulesUstad['no_kontak'] = 'required|min:11|max:20|unique:ustads';
        }

        // if(auth()->user()->role_id == 1)
        // {
        //     $r = User::where('id', $ustad->user_id)->first('username');
        //     // $ra = JSON.stringify($r);
        //     if($request->username != $user){
        //         // return $ra;
        //         return User::where('id', $ustad->user_id)->first('username');
        //         // return $request->username;
        //         $rulesUser['username'] = 'required|unique:users';
        //     }
        // }
        // else
        // {
        //     if($request->username != $user->username){
        //         $rulesUser['username'] = 'required|unique:users';
        //     }
        // }
        
        $validatedDataUstad = $request->validate(($rulesUstad));
        // $validatedDataUser = $request->validate(($rulesUser));
        // return $request->pasword_lama;
        Ustad::where('id', $ustad->id)->update($validatedDataUstad);
        // User::where('id', $ustad->user_id) ->update($validatedDataUser);

        return redirect('/dashboard/ustads')->with('success', 'Profil berhasi diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ustad $ustad)
    {
        // if($ustad->image){
        //     Storage::delete($ustad->image);
        // }

        Ustad::destroy($ustad->id);
        User::destroy('id', $ustad->user_id);
        return redirect('/dashboard/ustads')->with('success', 'Profil ustad dihapus!');
    }

    public function reset(Ustad $ustad)
    {

        $validatedData['password'] = 12345;
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::where('id',$ustad->user_id)->update($validatedData);

        return redirect('/dashboard/ustads')->with('success', 'password telah direset!');
    }
}
