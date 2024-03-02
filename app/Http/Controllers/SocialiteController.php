<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Student;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    //redirect to google
    public function signInwithGoogle()
    {
        return Socialite::driver("google")->redirect();
    }

    public function callbackfromgoogle()
    {
        try{
            $user = Socialite::driver('google')->user();
            $current_user = Student::where('google_id', $user->id)->first();
            if($current_user){
                Auth::login($current_user);
                return redirect('/showusers')->with('Completed', 'Successfully Updated!');
            }
            else{
                // create a new user
                $name=explode(' ', $user->name);
                $newUser=Student::create([
                    'first_name'=>$name[0],
                    'last_name'=>$name[1],
                    'google_id'=> $user->id,
                    'email' => $user->email,
                    'gender' => '',
                    'phone'=>'',
                    'password' => bcrypt($user->name),
                ]);
                if($newUser)
                {
                    auth::login($newUser);
                    return redirect('/showusers')->with('Completed', 'Successfully Updated!');
                }  
                
            }
        }
        catch(Exception $e){
            dd($e->getMessage());   
        }

    }   
}