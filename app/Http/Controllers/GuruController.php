<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $guru = User::where('role', 'Guru')->get();
            $pelajaran = Pelajaran::get();
            $total_guru = $guru->count();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Guru - List",
                'guru' => $guru,
                'total_guru' => $total_guru
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function create() {
        if (Auth::check()) {
            $kelas = Kelas::get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Guru - Tambah",
                'kelas' => $kelas,
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_guru) {
        if (Auth::check()) {
            $kelas = Kelas::get();
            $guru = User::where('id_user', $id_guru)->first();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Guru - Edit",
                'kelas' => $kelas,
                'guru' => $guru
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function store(Request $request) {
        if (Auth::check()) {
            $rules = [
                'nama_guru' => 'required|string',
                'alamat_guru' => 'required|string',
                'no_telp' => 'required|int',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ];
            $messages = [
                'nama_guru.required' => 'Nama guru wajib diisi',
                'nama_guru.string' => 'Nama guru tidak valid',
                'alamat_guru.required' => 'Alamat guru wajib diisi',
                'alamat_guru.string' => 'Alamat guru tidak valid',
                'no_telp.required' => 'No telp wajib diisi',
                'no_telp.int' => 'No telp tidak valid',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password wajib diisi',
                'password_confirmation.required' => 'Password wajib diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $guru = new User([
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'no_telp' => $request->get('no_telp'),
                'alamat' => $request->get('alamat_guru'),
                'nama' => $request->get('nama_guru'),
                'role' => "Guru"
            ]);
            $guru->save();
            return redirect('/dashboard/guru')->with('success', 'Data guru telah ditambahkan');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_guru) {
        if (Auth::check()) {
            $rules = [
                'nama_guru' => 'required|string',
                'alamat_guru' => 'required|string',
                'no_telp' => 'required|int',
                'email' => 'required|email',
            ];
            $messages = [
                'nama_guru.required' => 'Nama guru wajib diisi',
                'nama_guru.string' => 'Nama guru tidak valid',
                'alamat_guru.required' => 'Alamat guru wajib diisi',
                'alamat_guru.string' => 'Alamat guru tidak valid',
                'no_telp.required' => 'No telp wajib diisi',
                'no_telp.int' => 'No telp tidak valid',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email tidak valid',
            ];

            $guru = User::find($id_guru);
            if (!$guru) {
                echo "error"; die();
            }

            if($request->get('password') != null) {
                $rules = $rules + [
                    'password' => 'required|confirmed',
                ];
                $messages = $messages + [
                    'password.required' => 'Password wajib diisi',
                    'password_confirmation.required' => 'Password wajib diisi',
                ];
                $password = bcrypt($request->get('password'));
            }
            else {
                $password = $guru->password;
            }

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $guru->nama = $request->get('nama_guru');
            $guru->alamat = $request->get('alamat_guru');
            $guru->no_telp = $request->get('no_telp');
            $guru->email = $request->get('email');
            $guru->password = $password;
            $guru->update();
            return redirect('/dashboard/guru')->with('success', 'Data guru telah diperbaharui');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function delete($id_guru) {
        if (Auth::check()) {
            $guru = User::find($id_guru);
            if (!$guru) {
                echo "error"; die();
            }
            $guru->delete();
            return redirect('/dashboard/guru')->with('success', 'Data guru telah dihapus');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}