<?php

namespace App\Http\Controllers;

use App\Models\Kitab;
use App\Models\Nilai;
use App\Models\Rumpun;
use App\Models\Santri;
use App\Models\User;
use App\Models\Ustad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('admin'))
        {
            return view('dashboard.nilais.index', [
                'nilais' => Nilai::all()
            ]);
        }
        
        elseif(Gate::allows('ustad'))
        {
            return view('dashboard.nilais.index', [
                $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where("ustad_id", $ustad_id)->get()
            ]);
        }
        
        else
        {
            return view('dashboard.nilais.index', [
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('admin'))
        {
            return view('dashboard.nilais.create',[
                'rumpuns' => Rumpun::all(),
                'santris' => Santri::all(),
                'ustads' => Ustad::all(),
                'kitabs' => Kitab::all()
            ]);
        }
        
        elseif(Gate::allows('ustad'))
        {
            return view('dashboard.nilais.create',[
                'rumpuns' => Rumpun::all(),
                'santris' => Santri::all(),
                // 'ustads' => Ustad::all(),
                // 'ustads' => Ustad::where('user_id', auth()->user()->id)->pluck('id'),
                'kitabs' => Kitab::all()
            ]);
        }
        
        else
        {
            return view('dashboard.nilais.index', [
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('admin'))
        {
            $validatedData = $request->validate([
                'rumpun_id' => 'required',
                'santri_id' => 'required',
                'kitab_id' => 'required',
                'ustad_id' => 'required',
                'nilai' => 'required|integer'
            ]);
        }
        else
        {
            $validatedData = $request->validate([
                'rumpun_id' => 'required',
                'santri_id' => 'required',
                'kitab_id' => 'required',
                'nilai' => 'required|integer'
            ]);
            

            // $user_id = User::select('id', 'id as user_id');
            $user_id = Ustad::all()->pluck('id');
            // $validatedData['ustad_id'] = Ustad::where('user_id', $user_id)->pluck('id');
            dd($user_id);
        }

        Nilai::create($validatedData);

        return redirect('/dashboard/nilais')->with('success', 'Nilai baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        return view('dashboard.nilais.show',[
            'nilai' => $nilai

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        return view('dashboard.nilais.edit',[
            'nilai' => $nilai,
            'rumpuns' => Rumpun::all(),
            'santris' => Santri::all(),
            'ustads' => Ustad::all(),
            'kitabs' => Kitab::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        $rules = [
            'rumpun_id' => 'required',
            'santri_id' => 'required',
            'kitab_id' => 'required',
            'ustad_id' => 'required',
            'nilai' => 'required|integer'
        ];

        $validatedData = $request->validate(($rules));

        Nilai::where('id', $nilai->id)->update($validatedData);

        return redirect('/dashboard/nilais')->with('success', 'Nilai telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        Nilai::destroy($nilai->id);
        return redirect('/dashboard/nilais')->with('success', 'Nilai telah dihapus!');
    }
}
