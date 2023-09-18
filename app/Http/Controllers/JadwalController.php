<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function list($id_guru) {
        if (Auth::check()) {
            $guru = User::where('role', 'Guru')->where('id_user', $id_guru)->first();
            $jadwal = Jadwal::where('id_user', $id_guru)->get();
            $pelajaran = Pelajaran::get();
            $total_jadwal = $jadwal->count();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Jadwal - List",
                'guru' => $guru,
                'jadwal' => $jadwal,
                'total_jadwal' => $total_jadwal
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function create($id_guru) {
        if (Auth::check()) {
            $guru = User::where('role', 'Guru')->where('id_user', $id_guru)->first();
            $kelas = Kelas::get();
            $pelajaran = Pelajaran::get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Jadwal - Tambah",
                'guru' => $guru,
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_guru, $id_jadwal) {
        if (Auth::check()) {
            $guru = User::where('role', 'Guru')->where('id_user', $id_guru)->first();
            $jadwal = Jadwal::where('id_user', $id_guru)->where('id_jadwal', $id_jadwal)->first();
            $kelas = Kelas::get();
            $pelajaran = Pelajaran::get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Jadwal - Edit",
                'guru' => $guru,
                'kelas' => $kelas,
                'pelajaran' => $pelajaran,
                'jadwal' => $jadwal
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function store(Request $request, $id_guru) {
        if (Auth::check()) {
            $rules = [
                'id_kelas' => 'required|int',
                'id_pelajaran' => 'required|int',
                'hari' => 'required|string',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i',
            ];
            $messages = [
                'id_kelas.required' => 'Kelas wajib dipilih',
                'id_kelas.int' => 'Kelas tidak valid',
                'id_pelajaran.required' => 'Pelajaran wajib dipilih',
                'id_pelajaran.int' => 'Pelajaran tidak valid',
                'hari.required' => 'Hari wajib dipilih',
                'hari.string' => 'Hari tidak valid',
                'jam_mulai.required' => 'Jam mulai wajib diisi',
                'jam_selesai.required' => 'Jam selesai wajib diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $jadwal = new Jadwal([
                'id_user' => $id_guru,
                'id_kelas' => $request->get('id_kelas'),
                'id_pelajaran' => $request->get('id_pelajaran'),
                'hari' => $request->get('hari'),
                'jam_mulai' => $request->get('jam_mulai'),
                'jam_selesai' => $request->get('jam_selesai'),
            ]);

            $jadwal->save();
            return redirect('/dashboard/guru/jadwal/list/'.$id_guru)->with('success', 'Data jadwal baru telah ditambahkan');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_guru, $id_jadwal) {
        if (Auth::check()) {
            $rules = [
                'id_kelas' => 'required|int',
                'id_pelajaran' => 'required|int',
                'hari' => 'required|string',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i',
            ];
            $messages = [
                'id_kelas.required' => 'Kelas wajib dipilih',
                'id_kelas.int' => 'Kelas tidak valid',
                'id_pelajaran.required' => 'Pelajaran wajib dipilih',
                'id_pelajaran.int' => 'Pelajaran tidak valid',
                'hari.required' => 'Hari wajib dipilih',
                'hari.string' => 'Hari tidak valid',
                'jam_mulai.required' => 'Jam mulai wajib diisi',
                'jam_selesai.required' => 'Jam selesai wajib diisi',
            ];

            $guru = User::find($id_guru);
            if (!$guru) {
                echo "error"; die();
            }

            $jadwal = Jadwal::find($id_jadwal);
            if (!$jadwal) {
                echo "error"; die();
            }

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $jadwal->id_kelas = $request->get('id_kelas');
            $jadwal->id_pelajaran = $request->get('id_pelajaran');
            $jadwal->hari = $request->get('hari');
            $jadwal->jam_mulai = $request->get('jam_mulai');
            $jadwal->jam_selesai = $request->get('jam_selesai');
            $jadwal->update();
            return redirect('/dashboard/guru/jadwal/list/'.$id_guru)->with('success', 'Data jadwal telah diperbaharui');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function delete($id_guru, $id_jadwal) {
        if (Auth::check()) {
            $jadwal = Jadwal::find($id_jadwal);
            if (!$jadwal) {
                echo "error"; die();
            }
            $jadwal->delete();
            return redirect('/dashboard/guru/jadwal/list/'.$id_guru)->with('success', 'Data jadwal telah dihapus');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}