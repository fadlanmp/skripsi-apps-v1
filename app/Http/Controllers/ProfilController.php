<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Ustad;
use Illuminate\Support\Facades\Gate;



class ProfilController extends Controller
{
    public function index(Ustad $ustad, Santri $santri)
    {
        // pembagian role user
        if(Gate::allows('santri')) // role santri
        {
            return view('dashboard.profil.profil-santri',[
                'santri'  => $santri,
            ]);
        }
        
        else // role ustad
        {
            return view('dashboard.profil.profil-ustad',[
                'ustad' => $ustad
            ]);
        }
    }
}
