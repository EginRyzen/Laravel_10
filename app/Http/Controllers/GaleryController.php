<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galery::where('id_user', Auth::user()->id)->where('status', 'accept')->orderBy('created_at', 'desc')->get();
        return view('timeline', compact('galeri'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        $namafoto = Auth::user()->id . date('YmdHis') . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('foto'), $namafoto);

        Galery::create([
            'id_user' => Auth::user()->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namafoto,
        ]);
        return back();
    }

    public function editfoto(Request $request, $id)
    {
        if ($request->foto == null) {
            Galery::where('id', $id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            $request->validate([
                'foto' => 'required|image|mimes:png,jpg,jpeg',
            ]);
            $namafoto = Auth::user()->id . date('YmdHis') . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('foto'), $namafoto);

            Galery::where('id', $id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $namafoto,
            ]);
        }
        return back();
    }

    public function hapusfoto($id)
    {
        Galery::where('id', $id)->delete();
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galery $galery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galery $galery)
    {
        //
    }
}
