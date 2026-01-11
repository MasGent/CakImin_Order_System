<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        // Mengambil semua user, diurutkan dari yang terbaru
        $users = User::latest()->paginate(10);
        return view('pengguna.owner.Kelola_Pengguna.index', compact('users'));
    }

    /**
     * Menampilkan form tambah pengguna baru.
     */
    public function create()
    {
        return view('pengguna.owner.Kelola_Pengguna.create');
    }

    /**
     * Menyimpan data pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Owner hanya boleh mendaftarkan Kasir atau Dapur
            'role' => ['required', 'in:kasir,dapur'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Staff baru (Kasir/Dapur) berhasil didaftarkan.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Keamanan: Jangan biarkan owner menghapus dirinya sendiri
        if ($user->id === Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!')->withInput();
        }

        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Akses pengguna berhasil dicabut.');
    }
}