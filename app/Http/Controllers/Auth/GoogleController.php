<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
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
        }
        Auth::login($authUser, true);
        return redirect()->intended('/dashboard');
        // $status = User::findOrCreateUser($user);
        // dd($status);
    }
    private function getSocialAvatar($file, $path, $userId)
    {
        $fileContents = file_get_contents($file);
        $filename = $userId . '.jpg';
        $avatarPath = $path . $filename;
        Storage::put($avatarPath, $fileContents);
        return $filename;
    }
}
