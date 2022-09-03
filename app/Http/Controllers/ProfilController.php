<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Ustad;
use Illuminate\Support\Facades\Gate;



class ProfilController extends Controller
{
    public function index(Ustad $ustad, Santri $santri)
    {
        if(Gate::allows('santri'))
        {
            return view('dashboard.profil.profil-santri',[
                'santri'  => $santri,
        ]);
        }
        
        else
        {
            return view('dashboard.profil.profil-ustad',[
                'ustad' => $ustad
            ]);
        }
    }
}
