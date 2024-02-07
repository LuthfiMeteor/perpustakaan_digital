<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Routing\Route;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        if (Auth::check()) {
            if (!Auth::user()->google_id) {
                $connected_user = User::find(Auth::id());
                if($user->email != $connected_user->email){
                    return redirect()->route('profile.connections')->withErrors(['googlenotsame'=> 'Google Account not same with cridential.']);
                }
                $connected_user->google_id = $user->id;
                $connected_user->update();
                return redirect(route('profile.connections'));
            }else{
                $connected_user = User::find(Auth::id());
                if($user->email != $connected_user->email){
                    return redirect()->route('profile.connections')->withErrors(['googlenotsame'=> 'Google Account not same with cridential.']);
                }
                $connected_user->google_id = null;
                $connected_user->update();
                return redirect(route('profile.connections'));
            }
        } else {
            // dd($user);
            $authUser = User::where('google_id', $user->id)->first();
            $checkEmail = User::where('email', $user->email)->first();
            if ($checkEmail && !$checkEmail->google_id) {
                return redirect()
                    ->route('login')
                    ->withErrors(['google' => 'This email is already registered with password sign-in. Please sign in using your password.']);
            }
            $AvatarNama = $this->getSocialAvatar($user->avatar, 'public/profiles/', $user->id);
            if (!$authUser) {
                $authUser = User::create([
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $AvatarNama,
                ]);
                $authUser->assignRole('user');
                Auth::login($authUser, true);
                return redirect()->route('google.setup');
            }
        }
    }
    private function getSocialAvatar($file, $path, $userId)
    {
        $fileContents = file_get_contents($file);
        $filename = $userId . '.jpg';
        $avatarPath = $path . $filename;
        Storage::put($avatarPath, $fileContents);
        return $filename;
    }
    public function connectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googlePasswordSet(){
        return view('auth.google-setup');
    }
}
