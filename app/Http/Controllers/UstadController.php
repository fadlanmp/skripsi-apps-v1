<?php

namespace App\Http\Controllers;

use App\Models\Kitab;
use App\Models\Ustad;
use App\Models\Role;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Post;
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
            'kitabs' => Kitab::all()
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
        ]);

        $validatedDataUser['role_id'] = 2;

        $validatedDataUser['password'] = 12345;
        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
        
        $validatedDataUstad = $request->validate([
            'name' => 'required|max:55',
            'jk' => 'required',
            'no_kontak' => 'min:11|max:20|unique:ustads',
            'kitab_id' => 'required|unique:ustads'
        ]);
        User::create($validatedDataUser);
        $validatedDataUstad['user_id'] = User::all()->pluck('id')->last();
        Ustad::create($validatedDataUstad);

        return redirect('/dashboard/ustads')->with('success', 'User baru ustaz berhasil ditambahkan!');
        
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
     * @param  \App\Models\Kitab  $kitab
     * @return \Illuminate\Http\Response
     */
    public function edit(Ustad $ustad, Kitab $kitab)
    {
        return view('dashboard.ustads.edit',[
            'ustad' => $ustad,
            'kitabs' => Kitab::all()
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

        if($request->kitab != $ustad->kitab_id){
            $rulesUstad['kitab_id'] = 'required|unique:ustads';
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

        return redirect('/dashboard/ustads')->with('success', 'Profil ustaz berhasi diperbaharui!');
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


        Nilai::where('ustad_id', $ustad->id)->delete();
        Post::where('user_id', $ustad->user_id)->delete();
        Ustad::destroy($ustad->id);
        User::destroy($ustad->user_id);
        

        return redirect('/dashboard/ustads')->with('success', 'Profil ustaz berhasil dihapus!');
    }

    public function reset(Ustad $ustad)
    {

        $validatedData['password'] = 12345;
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::where('id',$ustad->user_id)->update($validatedData);

        return redirect('/dashboard/ustads')->with('success', 'password telah direset!');
    }
}
