<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNoAktif;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ManajemenUserNoAktifController extends Controller
{
    public function index()
    {
        return view('dashboard.manajemen_user_no_aktif.index');
    }


    public function edit ($id)
    {

        $data = User::where('id', '=', $id)->first();
        return view("dashboard.manajemen_user.edit", compact('data'));
    }

    public function update (Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            alert::warning('Pastikan data sesuai');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $data = user::where('id', '=', $request->id)
            ->first();

            $data->name = $request->name;
            $data->email = $request->email;

            if ($request->password) {
                $data->password = Hash::make($request->password);
            }


            $data->save();


            DB::commit();
            Alert::success('Sukses Edit Data');
            return redirect()->back();
        } catch (Exception $th) {
            //throw $th;

            DB::rollback();
            return redirect()->back()->with('error', 'Data  Gagal Di update');
        }
    }



    public function hapus ($id)
    {

        try {

            $data = UserNoAktif::where('id', '=', $id)->first();
            $data->delete();

            DB::commit();

            Alert::success('Sukses Menghapus Data');
            return redirect()->back();
        } catch (\Exception $th) {
            //throw $th;

            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Menghapus Data');
        }
    }


    public function json()
    {
        $data = UserNoAktif::all();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($data) {
            return $data->name;
        })

        ->addColumn('email', function ($data) {
            return $data->email;
        })

        ->addColumn('edit', function ($data) {
            return '
            <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-reload"></span>
            </button>';
        })
        ->rawColumns(['name','email','edit'])
        ->toJson();
    }

}
