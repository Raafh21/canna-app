<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function home()
    {
        return view('index', [
            'title' => 'Sipagung - Sistem Pakar Diagnosa Hama & Penyakit Jagung',

        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'Sipagung About - Sistem Pakar Diagnosa Hama & Penyakit Jagung',
            // 'settings' => Setting::orderby('id', 'asc')->get()
        ]);
    }

    public function admin()
    {
        $jumlahData = DB::table('tb_training')->count();
        $jumlahUser = DB::table('users')->count();

        return view('dashboard', [
            'title' => 'Dashboard',
            'jumlahData' => $jumlahData,
            'jumlahUser' => $jumlahUser,
        ]);
    }

    public function training()
    {
        return view('training', [
            'title' => 'training'
        ]);
    }

    public function login()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function login_process(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return redirect('/login')->with('status', 'Login Gagal!');
    }

    public function riwayat()
    {
        return view('riwayat.index', [
            'title' => 'riwayat',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('profile', [
            'title' => 'Profile',
            'user' => $user,
        ]);
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password_baru);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Diubah!');
    }

    public function ganti()
    {
        $user = User::find(auth()->user()->id);
        return view('ganti', [
            'title' => 'Ganti Password',
            'user' => $user,
        ]);
    }
}