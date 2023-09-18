<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function home() {
        if (Auth::check()) {
            $today = Carbon::now()->isoFormat('dddd');
            $now = Carbon::now();
            $jadwal_hari_ini = Jadwal::where('id_user', Auth::user()->id_user)->where('hari', $today)->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC')->get();
            foreach($jadwal_hari_ini as $j) {
                $jam_mulai = Carbon::createFromTimeString($j->jam_mulai);
                $jam_selesai = Carbon::createFromTimeString($j->jam_selesai);
                if($now->between($jam_mulai, $jam_selesai)) {
                    $absensi = Absensi::where('id_user', $j->id_user)
                        ->where('id_kelas', $j->id_kelas)
                        ->where('id_pelajaran', $j->id_pelajaran)
                        ->where('hari', $j->hari)
                        ->where('jam_mulai', $j->jam_mulai)
                        ->where('jam_selesai', $j->jam_selesai)
                        ->whereDate('created_at', Carbon::today())
                    ->first();
                    if($absensi) {
                        $j->status = "Sedang Berlangsung - Sudah Absen";
                        $j->id_absensi = $absensi->id_absensi;
                    }
                    else {
                        $j->status = "Sedang Berlangsung - Belum Absen";
                    }
                }
                elseif($now > $jam_selesai) {
                    $absensi = Absensi::where('id_user', $j->id_user)
                        ->where('id_kelas', $j->id_kelas)
                        ->where('id_pelajaran', $j->id_pelajaran)
                        ->where('hari', $j->hari)
                        ->where('jam_mulai', $j->jam_mulai)
                        ->where('jam_selesai', $j->jam_selesai)
                        ->whereDate('created_at', Carbon::today())
                    ->first();
                    if($absensi) {
                        $j->status = "Sudah Selesai - Sudah Absen";
                        $j->id_absensi = $absensi->id_absensi;
                    }
                    else {
                        $j->status = "Sudah Selesai - Belum Absen";
                    }
                }
                elseif($now < $jam_mulai) {
                    $j->status = "Belum Mulai";
                }
            }

            $jadwal_bulan_ini = Jadwal::where('id_user', Auth::user()->id_user)->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC')->get();

            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Dashboard",
                'jadwal_hari_ini' => $jadwal_hari_ini,
                'jadwal_bulan_ini' => $jadwal_bulan_ini,
                'now' => $now
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }
}