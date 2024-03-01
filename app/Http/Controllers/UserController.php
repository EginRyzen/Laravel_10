<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        User::create($data);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $status = User::where('username', $request->username)->where('status', 1)->first();
        if ($status) {
            if (Auth::attempt($request->only('username', 'password'))) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect('admin');
                }
                return redirect('timeline');
            } else {
                return back();
            }
        } else {
            return back()->with('alert', 'Anda Belum Di Acc Oleh Admin!!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
