<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\buku;

class ManajemenBukuController extends Controller
{
    public function index(){
        return view('dashboard.manajemen_buku.manajemenBuku');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            // 'penulis' => 'required',
            // 'kategori' => 'required',
            // 'buku' => 'required|mimes:pdf,doc,docx',
            // 'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::warning('Pastikan Kolom Terisi dengan Benar');
            return redirect()->back();
        } else {
            DB::beginTransaction();

            try {
                $buku = new Buku;
                $buku->judul_buku = $request->judul;
                $buku->deskripsi = $request->deskripsi;
                $buku->penulis = $request->penulis;
                $buku->kategori = $request->kategori;

                // Handle file uploads for 'buku'
                if ($request->hasFile('buku')) {
                    $bukuFileName = time() . '.' . $request->file('buku')->extension();
                    $request->file('buku')->move(public_path('uploads/buku'), $bukuFileName);
                    $buku->buku = $bukuFileName;
                }

                // Handle file uploads for 'cover'
                if ($request->hasFile('cover')) {
                    $coverFileName = time() . '.' . $request->file('cover')->extension();
                    $request->file('cover')->move(public_path('uploads/cover'), $coverFileName);
                    $buku->cover = $coverFileName;
                }

                $buku->save();

                DB::commit();
                Alert::success('Sukses Menambahkan Data Buku');
                return redirect()->back();
            } catch (Exception $th) {
                DB::rollback();
                Alert::error('Oops', 'Terjadi Kesalahan');
                return redirect()->back()->withInput();
            }
        }
    }

    public function lihat ($id) 
    {

        $data = buku::where('id', '=', $id)->first();
        return view("dashboard.manajemen_buku.lihat-buku", compact('data'));
    }

    public function edit ($id) 
    {
        $data = buku::where('id', '=', $id)->first();
        return view("dashboard.manajemen_buku.edit-buku", compact('data'));
    }

    public function update (Request $request)
{

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
        ]);

    if ($validator->fails()) {
        alert::warning('Pastikan data sesuai');
        return redirect()->back();
    }
    
    DB::beginTransaction();
    try {
        $data = buku::where('id', '=', $request->id)
        ->first();

        $data->judul_buku = $request->judul;
        $data->penulis = $request->penulis;
        $data->kategori = $request->kategori;

        if ($request->deskripsi != null) {
            $data->deskripsi = $request->deskripsi;
        }

        if ($request->cover) {
            $coverPath = public_path('uploads/cover/' . $data->cover);
            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }
            if ($request->hasFile('cover')) {
                $coverFileName = time() . '.' . $request->file('cover')->extension();
                $request->file('cover')->move(public_path('uploads/cover'), $coverFileName);
                $data->cover = $coverFileName;
            }
        }

        if ($request->hasFile('buku')) {
            $bukuPath = public_path('uploads/buku/' . $data->buku);
            if (File::exists($bukuPath)) {
                File::delete($bukuPath);
            }
        
            $bukuFileName = time() . '.' . $request->file('buku')->extension();
            $request->file('buku')->move(public_path('uploads/buku'), $bukuFileName);
            $data->buku = $bukuFileName;
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


    public function hapus($id)
    {
        DB::beginTransaction();

        try {
            $data = buku::findOrFail($id);

            $coverPath = public_path('uploads/cover/' . $data->cover);
            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }

            $bukuPath = public_path('uploads/buku/' . $data->buku);
            if (File::exists($bukuPath)) {
                File::delete($bukuPath);
            }

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
        $data = buku::all();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('judul', function ($data) {
            return $data->judul_buku;
        })
        ->addColumn('cover', function ($data) {
            return '<img src="' . asset('/uploads/cover/' . $data->cover) . '" alt="Cover" width="50" height="50">';
        })
        ->addColumn('penulis', function ($data) {
            return '<span class="ms-3 badge bg-label-primary">' . $data->penulis . '</span>';
        })
        ->addColumn('kategori', function ($data) {
            return '<span class="ms-3 badge bg-label-warning">' . $data->kategori . '</span>';
        })
        ->addColumn('edit', function ($data) {
            return '<button type="button" class="btn btn-xs btn-info btn-edit" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-pencil"></span>
            </button>
            <button type="button" class="btn btn-xs btn-danger btn-hapus" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-trash"></span>
            </button>
            <button type="button" class="btn btn-xs btn-primary btn-lihat" data-id="' . $data->id . '" >
            <span class="menu-icon tf-icons ti ti-eye"></span>
            </button>';
        })
        ->rawColumns(['judul','cover','penulis','kategori','edit'])
        ->toJson();     
    }
}
