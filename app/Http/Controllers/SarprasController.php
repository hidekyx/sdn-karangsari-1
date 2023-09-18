<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sarpras;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SarprasController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $sarpras = Sarpras::get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Sarpras - List",
                'sarpras' => $sarpras
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function create() {
        if (Auth::check()) {
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Sarpras - Tambah",
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_sarpras) {
        if (Auth::check()) {
            $sarpras = Sarpras::where('id_sarpras', $id_sarpras)->first();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Sarpras - Edit",
                'sarpras' => $sarpras
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
                'jenis_sarpras' => 'required|string',
                'jumlah' => 'required|int',
            ];
            $messages = [
                'jenis_sarpras.required' => 'Jenis sarana dan prasarana wajib dipilih',
                'jenis_sarpras.string' => 'Jenis sarana dan prasarana tidak valid',
                'jumlah.required' => 'Jumlah wajib diisi',
                'jumlah.int' => 'Jumlah tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $sarpras = new Sarpras([
                'jenis_sarpras' => $request->get('jenis_sarpras'),
                'jumlah' => $request->get('jumlah'),
            ]);
            $sarpras->save();
            return redirect('/dashboard/sarpras')->with('success', 'Data sarana dan prasarana telah ditambahkan');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_sarpras) {
        if (Auth::check()) {
            $rules = [
                'jenis_sarpras' => 'required|string',
                'jumlah' => 'required|int',
            ];
            $messages = [
                'jenis_sarpras.required' => 'Jenis sarana dan prasarana wajib dipilih',
                'jenis_sarpras.string' => 'Jenis sarana dan prasarana tidak valid',
                'jumlah.required' => 'Jumlah wajib diisi',
                'jumlah.int' => 'Jumlah tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $sarpras = Sarpras::find($id_sarpras);
            if (!$sarpras) {
                echo "error"; die();
            }
            $sarpras->jenis_sarpras = $request->get('jenis_sarpras');
            $sarpras->jumlah = $request->get('jumlah');
            $sarpras->update();
            return redirect('/dashboard/sarpras')->with('success', 'Data sarana dan prasarana telah diperbaharui');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function delete($id_sarpras) {
        if (Auth::check()) {
            $sarpras = Sarpras::find($id_sarpras);
            if (!$sarpras) {
                echo "error"; die();
            }
            $sarpras->delete();
            return redirect('/dashboard/sarpras')->with('success', 'Data sarana dan prasarana telah dihapus');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}