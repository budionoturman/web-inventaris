<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = User::all();

        return view('user/index',[
            'users' => $userData,
        ]);
    }

    public function create()
    {
        return view('user/create',[
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|unique:users',
            'password' => 'required|min:3',
            'no_hp' => 'required',
            'role_id' => 'required',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['nip'] = $request->nip;


        User::create($validatedData);
        return redirect('users')->with('success', 'Tambah User Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user/show', [
            'user' => $user,
            'peminjaman' => Peminjaman::where('status', 'sudah kembali')
                            ->where('user_id', $user->id)->get()
        ]);
    }
    public function edit(User $user)
    {
        return view('user/edit',[
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5',
            'password' => 'required|min:3',
            'no_hp' => 'required',
            'role_id' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['nip'] = $request->nip;

        User::where('id', $user->id)->update($validatedData);
        return redirect('users')->with('success', 'User Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('users')->with('success', 'User Berhasil Dihapus');
    }
}
