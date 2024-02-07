<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ],[
            'confirmPassword.same'=>'Confirm Password Not Same with new password',
        ]);
        if (!Hash::check($request->currentPassword, Auth::user()->password)) {
            return redirect()
                ->back()
                ->withErrors(['currentPassword' => 'Password does not match']);
        }
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->newPassword);
        $user->update();
        Auth::logout();
        return redirect()
            ->route('login')
            ->with('success', 'Password updated successfully');
    }
    public function profileConnections(){
        return view('dashboard.profiles.connecttions');
    }
}
