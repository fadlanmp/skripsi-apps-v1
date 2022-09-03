<?php

namespace App\Http\Controllers;

use App\Models\Kitab;
use App\Models\Rumpun;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;



class DashboardKitabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return Kitab::all();

        return view('dashboard.kitabs.index', [
            // 'posts' => Kitab::where('user_id', auth()->user()->id)->get() //untuk user
            'kitabs' => Kitab::all(), //untuk admin

            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kitabs.create',[
            'rumpuns' => Rumpun::all()
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:kitabs',
            'rumpun_id' => 'required',
            'image' => 'image|file|max:1024',
            'pengarang' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('kitab-images');
        }


        Kitab::create($validatedData);

        return redirect('/dashboard/kitabs')->with('success', 'Kitab baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kitab  $kitab
     * @return \Illuminate\Http\Response
     */
    public function show(Kitab $kitab)
    {
        return view('dashboard.kitabs.show',[
            'kitabs' => $kitab
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kitab  $kitab
     * @return \Illuminate\Http\Response
     */
    public function edit(Kitab $kitab)
    {
        return view('dashboard.kitabs.edit',[
            'kitab' => $kitab,
            'rumpuns' => Rumpun::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kitab  $kitab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitab $kitab)
    {
        $rules = [
            'title' => 'required|max:255',
            'rumpun_id' => 'required',
            'image' => 'image|file|max:1024',
            'pengarang' => 'required'
        ];

        

        if($request->slug != $kitab->slug){
            $rules['slug'] = 'required|unique:kitabs';
        }

        $validatedData = $request->validate(($rules));

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('kitab-images');
        }
        

        Kitab::where('id', $kitab->id)
            ->update($validatedData);

        return redirect('/dashboard/kitabs')->with('success', 'Kitab telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kitab  $kitab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kitab $kitab)
    {
        if($kitab->image){
            Storage::delete($kitab->image);
        }

        Kitab::destroy($kitab->id);
        return redirect('/dashboard/kitabs')->with('success', 'Kitab telah dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kitab::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
