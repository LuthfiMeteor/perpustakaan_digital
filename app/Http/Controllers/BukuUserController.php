<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\FavoritModel;
use App\Models\KomentarModel;
use App\Models\MembershipModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BukuUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request->judul) {
            $buku = buku::where('judul_buku', 'like', '%' . $request->judul . '%')->get();
        } else {
            $buku = buku::all();
        }
        return view('landing-page.bukuPage', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function favoriteList()
    {
        $favorit = DB::table('favorit')
            ->select('buku.*', 'favorit.id as favoritID')
            ->join('buku', 'favorit.buku_id', '=', 'buku.id')
            ->where('favorit.user_id', Auth::id())
            ->get();
        // dd($favorit);
        return view('dashboard.favorite.index', compact('favorit'));
    }
    public function favorite(Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($request->id);
            $favorit = FavoritModel::where('buku_id', $decrypted)->where('user_id', Auth::id())
                ->count();
            if ($favorit == 0) {
                // dd('awd');
                $Makefavorit = new FavoritModel();
                $Makefavorit->user_id = Auth::id();
                $Makefavorit->buku_id = $decrypted;
                $Makefavorit->save();
                return response(200);
            } else {
                $removeFavorit = FavoritModel::where('buku_id', $decrypted)->where('user_id', Auth::id())->delete();
                return response(200);
            }
        } catch (\Throwable $th) {
        }
    }

    public function kirimKomentar(Request $request)
    {
        try {
            $buku_id = Crypt::decrypt($request->buku_id);
            // dd($buku_id);
            $tambahKomentar = new KomentarModel();
            $tambahKomentar->buku_id = $buku_id;
            $tambahKomentar->user_id = Auth::id();
            $tambahKomentar->komentar = $request->komentar;
            $tambahKomentar->rating = $request->rating;
            $tambahKomentar->save();

            $comments = KomentarModel::where('buku_id', $buku_id)->get();
            $totalRating = 0;
            $jumlahRating = $comments->count();
            foreach ($comments as $comment) {
                $totalRating += $comment->rating;
            }

            $newAverageRating = $totalRating / $jumlahRating;

            $book = buku::find($buku_id);
            $book->rating = $newAverageRating;
            $book->save();

            return response(200);
        } catch (\Throwable $th) {
        }
    }

    public function bacaBuku($id)
    {
        $decrypted = Crypt::decrypt($id);
        $buku = buku::find($decrypted);
        $checkMember = MembershipModel::where('user_id', Auth::id())->count();
        return view('landing-page.BacaBukuPage', compact('buku', 'checkMember'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = buku::with('kategori')->where('id', $id)->first();
        // dd($buku);
        return view('landing-page.bukuDetail', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
