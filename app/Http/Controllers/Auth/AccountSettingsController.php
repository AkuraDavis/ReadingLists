<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Account Settings Page
     */
    public function index() {
        return view('auth.settings');
    }

    public function update(Request $request) {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'current-password' => 'required_with:password|string|min:6|confirmed|nullable',
            'password' => 'string|min:6|confirmed|nullable',
            ]);

        if($request['password']){
            if(Hash::check($request['current-password'], Auth::user()->password)){

                Auth::user()->password = Hash::make($request['password']);

            }else{
                return view('auth.settings')->withErrors([
                    'message' => 'Password was incorrect.'
                ]);
            }
        }

        Auth::user()->name = $request['name'];
        Auth::user()->save();

        session()->flash('message', 'Your account has been updated!');

        return redirect('/account');
    }
}
