<?php

namespace App\Http\Controllers;

use App\User;
// use App\UserInfo;
// use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Auth::id();
        $userInfo = User::find($authId);
        if($userInfo->is_admin){
            $usersInfo = User::with('userInfo')
                            ->where('is_admin','!=', true)
                            ->get();
            // dd($usersInfo);
            return view('auth.admin.adminHome')->with('usersInfo',$usersInfo);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authId = Auth::id();
        $userInfo = User::find($authId);
        if($userInfo->is_admin){
            $info = User::with('userInfo')->findOrFail($id);
            if($info){
                return view('auth.user.userHome')->with('userInfo',$info);
            }
        } else {
            abort(403);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authId = Auth::id();
        $userInfo = User::find($authId);
        if($userInfo->is_admin){
            $info = User::with('userInfo')->findOrFail($id);
            if($info){
                return view('auth.user.updateInfo')->with('userInfo',$info);
            }
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authId = Auth::id();
        $userInfo = User::find($authId);
        if($userInfo->is_admin){
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'mobile_no' => ['required', 'string', 'max:255'],
                'image' => ['required', 'mimes:jpeg,jpg,png,gif'],
                'DOB' => ['required'],
                'address' => ['required', 'string',],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
            ]);
    
            $profileInfo = User::with('userInfo')->findOrFail($id);
            $img_path=$profileInfo->userInfo->image;
            $hasFile = $request->hasFile('image');
    
            if($hasFile){
                $file = $request->file('image');
                $fileUrl = Storage::putFile('avadar',$file);
            
                $profileInfo->name = $validatedData['name'];
                $profileInfo->userInfo->mobile_no = $validatedData['mobile_no'];
                $profileInfo->userInfo->DOB = $validatedData['DOB'];
                $profileInfo->userInfo->address = $validatedData['address'];
                $profileInfo->userInfo->city = $validatedData['city'];
                $profileInfo->userInfo->state = $validatedData['state'];
                $profileInfo->userInfo->country = $validatedData['country'];
                $profileInfo->userInfo->image = $fileUrl;
    
                $profileInfo->save();
    
                Storage::delete($img_path);  
    
                return redirect('adminHome');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authId = Auth::id();
        $userInfo = User::find($authId);
        if($userInfo->is_admin){
            $info = User::findOrFail($id);
            if($info){
                $info->delete();
                return true;
            } else {
                return false;
            }
        } else {
            abort(403);
        }
    }
}
