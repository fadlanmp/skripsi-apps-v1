<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.santris.index', [
            'santris' => Santri::all()
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.santris.create',[
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
        $validatedDataUser['role_id'] = 3;

        $validatedDataUser['password'] = 12345;
        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
        User::create($validatedDataUser);

        $validatedDataSantri = $request->validate([
            'no_induk' => 'unique:santris',
            'name' => 'required|max:55',
            'jk' => 'required'
        ]);
        $validatedDataSantri['user_id'] = User::all()->pluck('id')->last();
        Santri::create($validatedDataSantri);

        return redirect('/dashboard/santris')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        return view('dashboard.santris.show',[
            'santri' => $santri
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        return view('dashboard.santris.edit',[
            'santri' => $santri
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        $rules = [
            'name' => 'required|max:55',
            'jk' => 'required'
        ];

        if($request->no_induk!= $santri->no_induk){
            $rules['no_induk'] = 'unique:santris';
        }

        $validatedData = $request->validate(($rules));

        Santri::where('id', $santri->id)->update($validatedData);


        return redirect('/dashboard/santris')->with('success', 'Profil berhasi diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        Santri::destroy($santri->id);
        User::destroy('id', $santri->user_id);
        return redirect('/dashboard/santris')->with('success', 'Profil ustad dihapus!');
    }

    public function reset(Santri $santri)
    {

        $validatedData['password'] = 12345;
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::where('id',$santri->user_id)->update($validatedData);

        return redirect('/dashboard/santris')->with('success', 'password telah direset!');
    }
}
