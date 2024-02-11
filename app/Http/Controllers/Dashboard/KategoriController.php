<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\kategori;

class KategoriController extends Controller
{
    public function index(){
        return view('dashboard.kategori.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::warning('Pastikan Kolom Terisi dengan Benar');
            return redirect()->back();
        } else {
            DB::beginTransaction();

            try {
                $data = new kategori;
                $data->nama = $request->nama;

                $data->save();

                DB::commit();
                Alert::success('Sukses Menambahkan Data data');
                return redirect()->back();
            } catch (Exception $th) {
                DB::rollback();
                Alert::error('Oops', 'Terjadi Kesalahan');
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit ($id) 
    {
        $data = kategori::where('id', '=', $id)->first();
        return view("dashboard.kategori.edit", compact('data'));
    }

    public function update (Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            ]);

        if ($validator->fails()) {
            alert::warning('Pastikan data sesuai');
            return redirect()->back();
        }
        
        DB::beginTransaction();
        try {
            $data = kategori::where('id', '=', $request->id)
            ->first();

            $data->nama = $request->nama;
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


    public function hapus($id)
    {
        DB::beginTransaction();

        try {
            $data = kategori::findOrFail($id);

            $data->delete();

            DB::commit();

            Alert::success('Sukses Menghapus Data');
            return redirect()->back();
        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Menghapus Data');
        }
    }

    public function json()
    {
        $data = kategori::all();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama', function ($data) {
            return $data->nama;
        })
        ->addColumn('edit', function ($data) {
            return '<button type="button" class="btn btn-xs btn-info btn-edit" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-pencil"></span>
            </button>
            <button type="button" class="btn btn-xs btn-danger btn-hapus" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-trash"></span>
            </button>';
        })
        ->rawColumns(['nama','edit'])
        ->toJson();     
    }
}
