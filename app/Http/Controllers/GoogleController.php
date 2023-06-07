<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage(){

        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(){

        try{
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id',$user->id)->first();

            if($finduser){

                Auth::login($finduser);
                return redirect()->intended('redirect');
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'address'=> 'South delhi',
                    'phone'=> '4535345345',
                    'google_id' => $user->google_id,
                    'password' => encrypt('12345678')
                ]);

                Auth::login($newUser);
                return redirect()->intended('redirect');
            }
        }

        catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
