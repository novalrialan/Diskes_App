<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Pegawai;

use  PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function profile()
    {
        $user = Auth::user();
        $pegawai = User::findOrFail(auth()->user()->id)->pegawai;
        return view('user.profile', compact('user', 'pegawai'));
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $foto = $request->file('foto');

        $nama_foto = rand() . $foto->getClientOriginalName();


        $foto->move('user_profile', $nama_foto);

        $user = User::findOrFail($request->id);
        $user->foto = $nama_foto;
        $user->update();

        return back();
    }

    public function deleteProfile(Request $request)
    {
        $foto = null;
        $user = User::findOrFail($request->id);
        $user->foto =  $foto;
        $user->save();

        $file = public_path('/user_profile/') . $request->foto;
        // cek jika gambar file fotonya  ada
        if (file_exists($file)) {
            # jika file img di temukan maka hapus dari directory img
            @unlink($file);
        }

        return back();
    }

    public function index()
    {
        if (auth()->user()->role == "superadmin") {
            $user = User::all();
            return view('user.index', compact('user'));
        }
        return redirect('/dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5|max:200',
            'email' => 'required|min:10|max:200',
            'password' => 'required|min:5|max:200',
            'role' => 'required|string',
            'subbagian_id' => 'required',
            'jabatan' => 'required|min:5|max:100'
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();


        if (isset($user)) {
            $pergawai = new Pegawai;
            $pergawai->nama_pegawai = $user->nama;
            $pergawai->subbagian_id = $request->subbagian_id;
            $pergawai->jabatan = $request->jabatan;
            $pergawai->user_id = $user->id;
            $pergawai->save();
        }
        return redirect()->intended('/')->with('success', 'Selamat anda sudah teregister');
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => 'required|min:10|max:200',
            'password' => 'required|min:5|max:200'
        ]);


        $getemail = $request->email;
        $getpassword = $request->password;


        if (Auth::attempt(['email' => $getemail, 'password' => $getpassword])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('Faild', 'Login Gagal silakan coba lagi.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('user.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|min:5|max:200|email|exists:users,email',
        ]);

        $token = Str::random(60);
        $email = $request->email;

        DB::table('password_reset')->insert([
            'email' => $email,
            'token' => $token
        ]);


        $body = "Kami menerima sebuah permintaan untuk menyetel ulang sandi password untuk akun Web DikesApp yang terkait dengan "
            . $request->email . " Kamu dapat mereset password dengan menekan tombol dibawah ini ";

        Mail::send('forget_password_email', ['token' => $token, 'body' => $body], function ($message) use ($request) {
            $message->from('noreply@example.com', 'Web DikesApp');
            $message->to($request->email, 'Email kamu')->subject('Reset password');
        });

        return back()->with('success', 'Kami telah mengirimkan link reset password ke email kamu!');
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('reset_password')->with(['token' => $token, 'email' => $request->email]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|min:5|max:200|email|exists:users,email',
            'password' => 'required|min:5|max:200',
            'password_confirm' => 'required',
        ]);

        $check_token = DB::table('password_reset')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$check_token) {
            return back()->with('faild', 'invalid token');
        } else {
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);

            DB::table('password_reset')->where([
                'email' => $request->email
            ])->delete();

            return redirect('/')->with('info', 'Password anda sudah diperbaharui! anda dapat login dengan password baru')
                ->with('verifiedEmail', $request->email);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5|max:200',
            'email' => 'required|min:10|max:200'
        ]);

        $user = User::findOrFail($request->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->update();

        if (isset($user)) {
            $pegawai = Pegawai::findOrFail($request->id);
            $pegawai->nama = $user->nama;
            $pegawai->email = $user->email;
            $pegawai->update();
        }

        session()->flash('success', 'data user berhasil diubah!');

        return back();
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        session()->flash('danger', 'data user berhasil dihapus.');

        return back();
    }

    public function roleUpdate(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->role = $request->role;
        $user->update();
        session()->flash('success', 'role user berhasil diupdate!');
        return back();
    }

    public function printPDF()
    {
        $user = User::all();

        return PDF::loadView('user.list-user-pdf', ['user' => $user])->stream();
    }
}
