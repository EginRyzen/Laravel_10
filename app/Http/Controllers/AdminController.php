<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->level == 'admin') {
            $users = User::where('level', 'user')->get();

            return view('admin', compact('users'));
        } else {
            return redirect('/');
        }
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
    public function show($id)
    {
        User::where('id', $id)->delete();
        return back();
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
    public function update(Request $request, $id)
    {
        $status = $request->status;

        if ($status == 'accept') {
            $data = [
                'status' => 'accept'
            ];

            Galery::where('id', $id)->update($data);

            return back();
        }
        if ($status == 'pedding') {
            $data = [
                'status' => 'pending'
            ];

            Galery::where('id', $id)->update($data);

            return back();
        }
        if ($status == 'declined') {
            $data = [
                'status' => 'declined'
            ];

            Galery::where('id', $id)->update($data);

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->status == '1') {
            $data = [
                'status' => '0'
            ];

            User::where('id', $id)->update($data);

            return back();
        } else {
            $data = [
                'status' => '1'
            ];

            User::where('id', $id)->update($data);

            return back();
        }
    }
    public function accImage()
    {
        $galerys = Galery::join('users', 'users.id', '=', 'galeries.id_user')
            ->where('galeries.status', 'pending')
            ->select('galeries.*', 'users.username')
            ->get();

        return view('imageadmin', compact('galerys'));
    }
}
