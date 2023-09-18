<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DetailAbsensi;
use App\Models\Jadwal;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Sarpras;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        return view("main", [
            'page' => "Home",
            'kegiatan' => $kegiatan
        ]);
    }

    public function profil_identitas() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        return view("main", [
            'page' => "Profil",
            'subpage' => "Identitas Sekolah",
            'kegiatan' => $kegiatan
        ]);
    }
    
    public function profil_profil() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        return view("main", [
            'page' => "Profil",
            'subpage' => "Profil Sekolah",
            'kegiatan' => $kegiatan
        ]);
    }

    public function profil_sarana() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        $sarpras = Sarpras::get();
        return view("main", [
            'page' => "Profil",
            'subpage' => "Sarana dan Prasarana",
            'sarpras' => $sarpras,
            'kegiatan' => $kegiatan
        ]);
    }

    public function guru_list() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        $guru = User::where('role', 'Guru')->get();
        return view("main", [
            'page' => "Profil",
            'subpage' => "Daftar Guru dan Karyawan",
            'guru' => $guru,
            'kegiatan' => $kegiatan
        ]);
    }

    public function guru_detail($id_guru) {
        $guru = User::where('role', 'Guru')->where('id_user', $id_guru)->first();
        $guru['pelajaran'] = Pelajaran::where('id_pelajaran', $guru->id_pelajaran)->first();
        $guru['jadwal'] = Jadwal::where('id_user', $id_guru)->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC')->get();
        foreach ($guru['jadwal'] as $key => $gj) {
            $guru['jadwal'][$key]['kelas'] = $gj->kelas->nama_kelas;
            $guru['jadwal'][$key]['pelajaran'] = $gj->pelajaran->nama_pelajaran;
        }
        if($guru == null) {
            $success = false;
            $message = "Data guru tidak ditemukan";
        }
        else {
            $success = true;
            $message = "Data guru ditemukan";
        }
        return response()->json([
            'success'  => $success,
            'message'  => $message,
            'guru'  => $guru,
        ]);
    }

    public function siswa() {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->limit(6)->get();
        $siswa = Siswa::orderBy('id_kelas', 'ASC')->orderBy('nama_siswa', 'ASC')->get();
        return view("main", [
            'page' => "Profil",
            'subpage' => "Detail Siswa",
            'siswa' => $siswa,
            'kegiatan' => $kegiatan
        ]);
    }

    public function siswa_detail($id_siswa) {
        $siswa = Siswa::where('id_siswa', $id_siswa)->first();
        $siswa['kelas'] = Kelas::where('id_kelas', $siswa->id_kelas)->first();
        $siswa['absensi'] = Absensi::where('id_kelas', $siswa->id_kelas)->orderBy('updated_at', 'DESC')->get();
        foreach($siswa['absensi'] as $key => $a) {
            $siswa['absensi'][$key]['detail'] = DetailAbsensi::where('id_absensi', $a->id_absensi)->where('id_siswa', $id_siswa)->first();
            $siswa['absensi'][$key]['tanggal'] = Carbon::parse($a->created_at)->isoFormat('D MMMM Y');
            $siswa['absensi'][$key]['pelajaran'] = Pelajaran::where('id_pelajaran', $a->id_pelajaran)->first();
        }
        if($siswa == null) {
            $success = false;
            $message = "Data siswa tidak ditemukan";
        }
        else {
            $success = true;
            $message = "Data siswa ditemukan";
        }
        return response()->json([
            'success'  => $success,
            'message'  => $message,
            'siswa'  => $siswa,
        ]);
    }
}