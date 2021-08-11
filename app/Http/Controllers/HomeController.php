<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile Updated Successfully');
    }

    public function changePassword(Request $request)
    {
        $current_pass = Hash::make($request->current_password);
        $new_pass = $request->new_password;
        $confirm_pass = $request->confirm_password;
        $user = User::where('password',$current_pass)->first();
        if($user->id){
            if($new_pass == $confirm_pass){
                $pass = Hash::make($new_pass);
                $user->password = $pass;
                $user->save();
                return redirect()->route('profile')->with('success', 'Password Changed Successfully');
            }else{
                return redirect()->route('profile')->with('error', 'Password not matched');
            }
        }else{
            return redirect()->route('profile')->with('error', 'Password not matched');
        }
    }

    public function statusUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->status = $request->status;
        $user->save();
        return redirect()->route('profile')->with('success', 'Status Updated Successfully');
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return 'success';
    }

    public function dashboard(){
        $data['users'] = User::where('user_type','<>','Admin')->get();
        return view('dashboard',$data);
    }

    public function edit(Request $request, $id){
        $data['users'] = User::where('user_type','<>','Admin')->get();
        return view('dashboard',$data);
    }

    public function delete(Request $request, $id){
        $data['users'] = User::where('user_type','<>','Admin')->get();
        return view('dashboard',$data);
    }
}
