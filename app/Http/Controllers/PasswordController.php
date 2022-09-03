<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\User;
use App\Models\Ustad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function index(User $user)
    {
        return view('dashboard.password',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user, Ustad $ustad)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
    
        if(Gate::allows('admin'))
        {

            if(Hash::check($request->password_lama, $user->password )){

                User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                if($user->role_id == 2){
                    return redirect("/dashboard/ustads/")->with('success', 'Password berhasil diubah!');
                }
                elseif($user->role_id == 3){
                    return redirect("/dashboard/santris/")->with('success', 'Password berhasil diubah!');
                }
                else{
                    return 1;
                }
            }
            else
            {
                throw ValidationException::withMessages([
                    'password_lama' => 'Password lama tidak sesuai'
                ]);
            }
        }
        elseif(Gate::any(['ustad','santri']))
        {
            if(Hash::check($request->password_lama, auth()->user()->password)){
                
                auth()->user()->update(['password' => Hash::make($request->password)]);
                
                return redirect('/dashboard/profil')->with('success', 'Password berhasil diubah!');
            }
            else
            {
                throw ValidationException::withMessages([
                    'password_lama' => 'Password lama kamu tidak sesuai'
                ]);
            }
        }

        // Hash::make($request['password_lama']);

        // return $request;
        // if(Auth::attempt(['password' => $request['password_lama']])){
        //     return $validatedData;
        // }
        else{

            return 2;
        }
    }

}
