<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.profiles.account');
    }
    public function updateAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:15',
            'uploadphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('uploadphoto')) {
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
        return view('dashboard.profiles.security', compact('logs'));
    }
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'currentPassword' => 'required',
                'newPassword' => 'required|min:8',
                'confirmPassword' => 'required|same:newPassword',
            ],
            [
                'confirmPassword.same' => 'Confirm Password Not Same with new password',
            ],
        );
        if (!Hash::check($request->currentPassword, Auth::user()->password)) {
            return redirect()
                ->back()
                ->withErrors(['currentPassword' => 'Password does not match']);
        }
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->newPassword);
        $user->update();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Password updated successfully');
    }
    public function profileConnections()
    {
        return view('dashboard.profiles.connecttions');
    }
    public function memberhsipUser()
    {
        return view('dashboard.profiles.membership');
    }
    public function buyMembership(Request $request)
    {
        // dd($request->all());
        $orderNumber = 'ORD' . Str::random(8);
        if ($request->membership_type == '1') {
            $price = 10000;
        }elseif($request->membership_type == '2'){
            $price = 30000;
        }elseif($request->membership_type == '3'){
            $price = 100000;
        }
        // dd($price);
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderNumber,
                'gross_amount' => $price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'last_name' => '',
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $data = [
            'order_number' => $orderNumber,
            'user_id' => Auth::user()->id,
            'harga' => $price,
            'status' => 'proses',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $order = DB::table('transaksi')->insert($data);
        return response()->json(['snaptoken' => $snapToken]);
    }
    public function MidtranCallback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        // dd($hashed);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $transaksi = DB::table('transaksi')->where('order_number', $request->order_id)->first();
                
            }
        }
    }
}
