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
                'nilais' => Nilai::all()]
            );
        }

        elseif(Gate::allows('ustad')){
            $post = [];
            $posts = [];
            foreach($categories as $category){
                $post[] = $category->name;
                $posts[] = Post::where('category_id', $category->id)->where('user_id', auth()->user()->id)->count();
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
                'posts' => $posts
                // $ustad_id = Ustad::where('user_id', auth()->user()->id)->pluck('id'),
                // 'nilais' => Nilai::where("ustad_id", $ustad_id)->get()
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
