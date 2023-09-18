<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $kelas = Kelas::get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Kelas - List",
                'kelas' => $kelas
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }
}