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
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Gate::allows('admin')){
            return view('dashboard.nilais.index', [
                'nilais' => Nilai::all()
            ]);
        }
        elseif(Gate::allows('ustad')){
            return view('dashboard.nilais.index', [
                $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where("ustad_id", $ustad_id)->get()
            ]);
        }
        else{
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
    public function create(Nilai $nilai, Kitab $kitab)
    {
        if(Gate::allows('admin'))
        {
            return view('dashboard.nilais.create',[
                'nilai' => $nilai,
                'kitab' => $kitab,
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
                // 'rumpun_id' => 'required',
                'santri_id' => 'required',
                // 'kitab_id' => 'required',
                'ustad_id' => 'required',
                'nilai' => 'required|integer'
            ]);

            // $validatedData['rumpun_id'] = '1';
            $kosong = DB::table('ustads')->where('id', $validatedData['ustad_id'])->first();
            $validatedData['kitab_id'] = $kosong->kitab_id;

            // dd($validatedData);
        }
        else
        {
            $validatedData = $request->validate([
                // 'rumpun_id' => 'required',
                'santri_id' => 'required',
                // 'kitab_id' => 'required',
                'nilai' => 'required|integer'
            ]);
            
            $validatedData['ustad_id'] = Ustad::where('user_id', auth()->user()->id)->first()->id;
            $validatedData['kitab_id'] = Ustad::where('user_id', auth()->user()->id)->first()->kitab_id;
            // dd($validatedData);
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
    public function edit(Nilai $nilai){
        if(Gate::allows('admin')){
            return view('dashboard.nilais.edit',[
                'nilai' => $nilai,
                'rumpuns' => Rumpun::all(),
                'santris' => Santri::all(),
                'ustads' => Ustad::all(),
                'kitabs' => Kitab::all()
            ]);
        }
        elseif(Gate::allows('ustad')){
            return view('dashboard.nilais.edit',[
                'nilai' => $nilai,
                'rumpuns' => Rumpun::all(),
                'santris' => Santri::all(),
                'kitabs' => Kitab::all()
            ]);
        }
        else{
            return view('dashboard.nilais.index', [
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()
            ]);
        }
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
        if(Gate::allows('admin'))
        {
            $rules = [
                // 'rumpun_id' => 'required',
                'santri_id' => 'required',
                // 'kitab_id' => 'required',
                'ustad_id' => 'required',
                'nilai' => 'required|integer'
            ];
            $kosong = DB::table('ustads')->where('id', $rules['ustad_id'])->first();
            $rules['kitab_id'] = $kosong->kitab_id;
        }
        
        elseif(Gate::allows('ustad'))
        {
            $rules = [
                'rumpun_id' => 'required',
                'santri_id' => 'required',
                'kitab_id' => 'required',
                'nilai' => 'required|integer'
            ];
        }
        
        else
        {
            return view('dashboard.nilais.index', [
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()
            ]);
        }

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
