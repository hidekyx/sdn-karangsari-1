<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $siswa = Siswa::get();
            $total_siswa = $siswa->count();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Siswa - List",
                'siswa' => $siswa,
                'total_siswa' => $total_siswa
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
                'page' => "Siswa - Tambah",
                'kelas' => $kelas,
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_siswa) {
        if (Auth::check()) {
            $kelas = Kelas::get();
            $siswa = Siswa::where('id_siswa', $id_siswa)->first();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Siswa - Edit",
                'kelas' => $kelas,
                'siswa' => $siswa
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
                'id_kelas' => 'required|int',
                'nama_siswa' => 'required|string',
                'alamat_siswa' => 'required|string',
                'tanggal_lahir' => 'required|date',
            ];
            $messages = [
                'id_kelas.required' => 'Kelas wajib dipilih',
                'id_kelas.int' => 'Kelas tidak valid',
                'nama_siswa.required' => 'Nama siswa wajib dipilih',
                'nama_siswa.string' => 'Nama siswa tidak valid',
                'alamat_siswa.required' => 'Alamat siswa wajib dipilih',
                'alamat_siswa.string' => 'Alamat siswa tidak valid',
                'tanggal_lahir.required' => 'Tanggal lahir wajib dipilih',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $siswa = new Siswa([
                'id_kelas' => $request->get('id_kelas'),
                'nama_siswa' => $request->get('nama_siswa'),
                'alamat_siswa' => $request->get('alamat_siswa'),
                'tanggal_lahir' => $request->get('tanggal_lahir'),
            ]);
            $siswa->save();
            return redirect('/dashboard/siswa')->with('success', 'Data siswa telah ditambahkan');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_siswa) {
        if (Auth::check()) {
            $rules = [
                'id_kelas' => 'required|int',
                'nama_siswa' => 'required|string',
                'alamat_siswa' => 'required|string',
                'tanggal_lahir' => 'required|date',
            ];
            $messages = [
                'id_kelas.required' => 'Kelas wajib dipilih',
                'id_kelas.int' => 'Kelas tidak valid',
                'nama_siswa.required' => 'Nama siswa wajib dipilih',
                'nama_siswa.string' => 'Nama siswa tidak valid',
                'alamat_siswa.required' => 'Alamat siswa wajib dipilih',
                'alamat_siswa.string' => 'Alamat siswa tidak valid',
                'tanggal_lahir.required' => 'Tanggal lahir wajib dipilih',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $siswa = Siswa::find($id_siswa);
            if (!$siswa) {
                echo "error"; die();
            }
            $siswa->id_kelas = $request->get('id_kelas');
            $siswa->nama_siswa = $request->get('nama_siswa');
            $siswa->alamat_siswa = $request->get('alamat_siswa');
            $siswa->tanggal_lahir = $request->get('tanggal_lahir');
            $siswa->update();
            return redirect('/dashboard/siswa')->with('success', 'Data siswa telah diperbaharui');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function delete($id_siswa) {
        if (Auth::check()) {
            $siswa = Siswa::find($id_siswa);
            if (!$siswa) {
                echo "error"; die();
            }
            $siswa->delete();
            return redirect('/dashboard/siswa')->with('success', 'Data siswa telah dihapus');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}