<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kitab;
use App\Models\Post;
use App\Models\Ustad;
use App\Models\Santri;
use App\Models\Nilai;
use App\Models\Rumpun;
use App\Models\User;
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
        $categories = Category::all();
        $post = [];
        $posts = [];
        $kitabs = Kitab::all();
        $kitab = [];
        $nilai = [];
        $rumpuns = Rumpun::all();
        $rumpun = [];
        $jmlRumpun = [];
        foreach($rumpuns as $r){
            $rumpun[] = $r->name;
            $jmlRumpun[] = Kitab::where('rumpun_id', $r->id)->count();
        }

        // pembagian role untuk menampilkan data pada dashboard
        if(Gate::allows('admin')){
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->count();
            }
            foreach($kitabs as $k){
                $kitab[] = $k->title;
                $nilai[] = (float) Nilai::where('kitab_id', $k->id)->avg('nilai');
            }
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'santrilk' => $santrilk,
                'santriptr' => $santriptr,
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'rumpun' => $rumpun,
                'jmlRumpun' => $jmlRumpun,
                'post' => $post,
                'posts' => $posts,
                'kitab' => $kitab,
                'nilai' => $nilai
            ]);
        }

        elseif(Gate::allows('ustad')){
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->where('user_id', auth()->user()->id)->count();
            }
            $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id')->first();
            foreach($kitabs as $k){
                $kitab[] = $k->title;
                $nilai[] = (float) Nilai::where('kitab_id', $k->id)->where('ustad_id', $ustad_id)->avg('nilai');
            }
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'santrilk' => $santrilk,
                'santriptr' => $santriptr,
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'rumpun' => $rumpun,
                'jmlRumpun' => $jmlRumpun,
                'post' => $post,
                'posts' => $posts,
                'kitab' => $kitab,
                'nilai' => $nilai
                ]
            );
        }

        elseif(Gate::allows('santri')){
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->where('user_id', auth()->user()->id)->count();
            }
            $santri_id = Santri::where('user_id', auth()->user()->id)->pluck('id')->first();
            foreach($kitabs as $k){
                $kitab[] = $k->title;
                $nilai[] = (float) Nilai::where('kitab_id', $k->id)->where('santri_id', $santri_id)->avg('nilai');
            }
            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'rumpun' => $rumpun,
                'jmlRumpun' => $jmlRumpun,
                'post' => $post,
                'posts' => $posts,
                'kitab' => $kitab,
                'nilai' => $nilai
            ]);
        }
    }
}
