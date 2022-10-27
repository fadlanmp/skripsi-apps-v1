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
        $rumpuns = Rumpun::all();
        $rumpun = [];
        $jmlRumpun = [];
        foreach($rumpuns as $r){
            $rumpun[] = $r->name;
            $jmlRumpun[] = Kitab::where('rumpun_id', $r->id)->count();
        }
        $categories = Category::all();


        if(Gate::allows('admin')){
            $post = [];
            $posts = [];
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->count();
            }
            $kitabs = Kitab::all();
            $kitab = [];
            $nilai = [];
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
            $post = [];
            $posts = [];
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->where('user_id', auth()->user()->id)->count();
            }
            $users = User::all();
            $ustad = Ustad::all();
            $santri = Santri::all();
            $n = Nilai::all();
            $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id')->first();
            $kitabs = Kitab::all();
            $kitab = [];
            $nilai = [];
            foreach($kitabs as $k){
                if($n->kitab_id == $k->id && $n->ustad_id == $ustad_id){
                    $kitab[] = $k->title;
                    $nilai[] = (float) Nilai::where('kitab_id', $k->id)->avg('nilai');
                }
            }
            dd($nilai);

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
            $post = [];
            $posts = [];
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->where('user_id', auth()->user()->id)->count();
            }

            return view('admin.dashboard',[
                'title' => 'Dashboard',
                'active' => 'home',
                'ustadlk' => $ustadlk,
                'ustadptr' => $ustadptr,
                'rumpun' => $rumpun,
                'jmlRumpun' => $jmlRumpun,
                'post' => $post,
                'posts' => $posts
            ]);
        }
    }
}
