<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
       return Socialite::driver($provider)->redirect();


    }
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login');        
            
        }

        $existingUser = Customer::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->guard('web')->login($existingUser);
            Cart::restore(auth()->id());
        } else {
            if($provider=="facebook"){
            $name = explode(" ", $user['name']);
            $lastname = array_pop($name);
            $firstname = implode(" ", $name);
            
            }else{
                // dd($user->user);
            $firstname=$user->user['email'];
            $lastname=$user->user['email'];
            }
            $newUser                    = new Customer();
            $newUser->provider     = $provider;
            $newUser->provider_user_id       = $user->getId();
            $newUser->fname              =$firstname ;
            $newUser->lname              =$lastname ;

            $newUser->email             = $user->getEmail();
            $newUser->save();

            auth()->guard('web')->login($newUser);
            Cart::restore(auth()->id());
        }

        return redirect()->route('home');
    }
}
