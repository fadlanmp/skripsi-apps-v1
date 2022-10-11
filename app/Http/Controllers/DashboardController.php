<?php

namespace App\Http\Controllers;


use App\Models\Kitab;
use App\Models\Post;
use App\Models\Ustad;
use App\Models\Santri;
use App\Models\Nilai;
use App\Models\Rumpun;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {

        $santrilk = Santri::where('jk','laki-laki')->count();
        $santriptr = Santri::where('jk','perempuan')->count();
        $ustadlk = Ustad::where('jk','laki-laki')->count();
        $ustadptr = Ustad::where('jk','perempuan')->count();
        $rumpuns = Rumpun::all();
        $rumpun = [];
        $jmlRumpun = [];
        foreach($rumpuns as $r){
            $rumpun[] = $r->name;
            $jmlRumpun[] = Kitab::where('rumpun_id', $r->id)->count();
        }
        

        if(Gate::allows('admin')){
            dd($jmlRumpun);
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'santrilk' => $santrilk,
                'santriptr' => $santriptr,
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'rumpun' => $rumpun,
                'kitabs' => Kitab::all(),
                'posts' => Post::all(),
                'nilais' => Nilai::all()]
            );
        }

        elseif(Gate::allows('ustad')){
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'santrilk' => $santrilk,
                'santriptr' => $santriptr,
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'kitabs' => Kitab::all(),
                'posts' => Post::where('user_id', auth()->user()->id)->get(),
                $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where("ustad_id", $ustad_id)->get()
                ]
            );
        }

        elseif(Gate::allows('santri')){
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'kitabs' => Kitab::all(),
                'posts' => Post::where('user_id', auth()->user()->id)->get(),
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()]
            );
        }
    }
}
