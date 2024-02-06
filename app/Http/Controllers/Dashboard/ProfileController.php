<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.profiles.account');
    }
    public function updateAccount(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:15',
            'uploadphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('uploadphoto')){
            $file = $request->file('uploadphoto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profiles', $filename);
            $user = $request->user();
            $user->avatar = $filename;
            $user->update();
        }
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phoneNumber;
        $user->update();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function profileSecurity()
    {
        $logs = auth()->user()->authentications;
        return view('dashboard.profiles.security',compact('logs'));
    }
}
