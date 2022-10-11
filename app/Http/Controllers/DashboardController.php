<?php

namespace App\Http\Controllers;


use App\Models\Kitab;
use App\Models\Post;
use App\Models\Ustad;
use App\Models\Santri;
use App\Models\Nilai;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {

        if(Gate::allows('admin')){
            $santris = Santri::all();
            $jk = [];
            foreach($santris as $santri){
                $jk[] = $santri->jk;
            }
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'ustads' => Ustad::all(),
                'kitabs' => Kitab::all(),
                'posts' => Post::all(),
                'santris' => Santri::all(),
                'jk' => $jk,
                'nilais' => Nilai::all()]
            );
        }

        elseif(Gate::allows('ustad')){
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'ustads' => Ustad::all(),
                'kitabs' => Kitab::all(),
                'santris' => Santri::all(),
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
                'ustads' => Ustad::all(),
                'kitabs' => Kitab::all(),
                'posts' => Post::where('user_id', auth()->user()->id)->get(),
                $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id'),
                'nilais' => Nilai::where('santri_id', $santri_id)->get()]
            );
        }
    }
}
