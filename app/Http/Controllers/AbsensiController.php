<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DetailAbsensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $absensi = Absensi::where('id_user', Auth::user()->id_user)->orderBy('updated_at', 'DESC')->get();
            foreach($absensi as $a) {
                $a->jumlah_hadir = null;
                $a->jumlah_alpha = null;
                $a->jumlah_izin = null;
                $a->jumlah_sakit = null;
                $a->jumlah_siswa = $a->kelas->siswa->count();
                $a->persentase_hadir = null;
                $a->persentase_alpha = null;
                $a->persentase_izin = null;
                $a->persentase_sakit = null;
                foreach($a->detail as $d) {
                    if($d->status == "Hadir") {
                        $a->jumlah_hadir = $a->jumlah_hadir + 1;
                        $a->persentase_hadir = $a->jumlah_hadir*100/$a->jumlah_siswa;
                    }
                    else if($d->status == "Alpha") {
                        $a->jumlah_alpha = $a->jumlah_alpha + 1;
                        $a->persentase_alpha = $a->jumlah_alpha*100/$a->jumlah_siswa;
                    }
                    else if($d->status == "Izin") {
                        $a->jumlah_izin = $a->jumlah_izin + 1;
                        $a->persentase_izin = $a->jumlah_izin*100/$a->jumlah_siswa;
                    }
                    else if($d->status == "Sakit") {
                        $a->jumlah_sakit = $a->jumlah_sakit + 1;
                        $a->persentase_sakit = $a->jumlah_sakit*100/$a->jumlah_siswa;
                    }
                }
            }

            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Absensi - List",
                'absensi' => $absensi,
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function detail($id_absensi) {
        if (Auth::check()) {
            $absensi = Absensi::where('id_user', Auth::user()->id_user)->where('id_absensi', $id_absensi)->first();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Absensi - Detail",
                'absensi' => $absensi,
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function create($id_jadwal) {
        if (Auth::check()) {
            $now = Carbon::now();
            $jadwal = Jadwal::where('id_user', Auth::user()->id_user)->where('id_jadwal', $id_jadwal)->first();

            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Absensi - Create",
                'jadwal' => $jadwal,
                'now' => $now
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_jadwal, $id_absensi) {
        if (Auth::check()) {
            $now = Carbon::now();
            $jadwal = Jadwal::where('id_user', Auth::user()->id_user)->where('id_jadwal', $id_jadwal)->first();
            $absensi = Absensi::where('id_absensi', $id_absensi)->first();

            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Absensi - Edit",
                'jadwal' => $jadwal,
                'absensi' => $absensi,
                'now' => $now
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function store(Request $request, $id_jadwal) {
        if (Auth::check()) {
            $rules = [
                'kehadiran' => 'required|array',
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
            
            $jadwal = Jadwal::find($id_jadwal);
            if (!$jadwal) {
                echo "error"; die();
            }

            $absensi = new Absensi([
                'id_user' => Auth::user()->id_user,
                'id_kelas' => $jadwal->kelas->id_kelas,
                'id_pelajaran' => $jadwal->pelajaran->id_pelajaran,
                'hari' => $jadwal->hari,
                'jam_mulai' => $jadwal->jam_mulai,
                'jam_selesai' => $jadwal->jam_selesai
            ]);

            $kehadiran = $request->get('kehadiran');
            $keterangan = $request->get('keterangan');
            if($keterangan == null) {
                $keterangan = array();
            }

            try {
                DB::beginTransaction();
                $absensi->save();
                foreach($kehadiran as $key => $k) {
                    if(array_key_exists($key, $keterangan)) {
                        $keterangan_save = $keterangan[$key];
                    }
                    else {
                        $keterangan_save = null;
                    }
                    $detail_absensi = new DetailAbsensi([
                        'id_absensi' => $absensi->id_absensi,
                        'id_siswa' => $key,
                        'status' => $k,
                        'keterangan' => $keterangan_save
                    ]);
                    $detail_absensi->save();
                }
                DB::commit();
                return redirect('/dashboard/')->with('success', 'Data absensi telah disimpan');
            } 
            catch(\Exception $e) {
                DB::rollback();
                dd($e); // error transaction
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_absensi) {
        if (Auth::check()) {
            $rules = [
                'kehadiran' => 'required|array',
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
            
            $absensi = Absensi::find($id_absensi);
            if (!$absensi) {
                echo "error"; die();
            }

            $kehadiran = $request->get('kehadiran');
            $keterangan = $request->get('keterangan');

            if($keterangan == null) {
                $keterangan = array();
            }

            try {
                DB::beginTransaction();
                $absensi->update();
                foreach($absensi->detail as $d) {
                    $d->delete();
                }
                foreach($kehadiran as $key => $k) {
                    if(array_key_exists($key, $keterangan)) {
                        $keterangan_save = $keterangan[$key];
                    }
                    else {
                        $keterangan_save = null;
                    }
                    $detail_absensi = new DetailAbsensi([
                        'id_absensi' => $absensi->id_absensi,
                        'id_siswa' => $key,
                        'status' => $k,
                        'keterangan' => $keterangan_save
                    ]);
                    $detail_absensi->save();
                }
                DB::commit();
                return redirect('/dashboard/')->with('success', 'Data absensi telah diperbaharui');
            } 
            catch(\Exception $e) {
                DB::rollback();
                dd($e); // error transaction
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}