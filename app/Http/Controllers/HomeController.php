<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authId = Auth::id();
        $user = User::find($authId);

        $redirectRoute=null;

        if($user['is_admin']){
            $redirectRoute=route('adminHome');
        } else {
            $redirectRoute=route('userHome');
        }    
        
        echo "<script>setTimeout(function(){ window.location.href = '".$redirectRoute."'; }, 3000);</script>";

        return view('home');

    }
}
