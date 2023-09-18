<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;

class KegiatanController extends Controller
{
    public function list() {
        if (Auth::check()) {
            $kegiatan = Kegiatan::orderBy('id_kegiatan', 'DESC')->get();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Kegiatan - List",
                'kegiatan' => $kegiatan
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
                'page' => "Kegiatan - Tambah",
            ]);
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function edit($id_kegiatan) {
        if (Auth::check()) {
            $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)->first();
            return view("dashboard.main", [
                'logged_user' => Auth::user(),
                'page' => "Kegiatan - Edit",
                'kegiatan' => $kegiatan
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
                'judul' => 'required|string',
                'gambar' => 'required|image',
                'tanggal' => 'required|date',
                'link' => 'required|string',
            ];
            $messages = [
                'judul.required' => 'Jenis wajib diisi',
                'judul.string' => 'Jenis tidak valid',
                'gambar.required' => 'Gambar wajib diupload',
                'gambar.image' => 'Gambar tidak valid',
                'tanggal.required' => 'Tanggal wajib diisi',
                'tanggal.date' => 'Tanggal tidak valid',
                'link.required' => 'Jenis wajib diisi',
                'link.string' => 'Jenis tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $gambar = null;
            if ($request->hasFile('gambar')) {
                $filenameWithExt = $request->file('gambar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $filenameSimpan = md5($filename. time()).'.'.$extension;
                $gambar = $filenameSimpan;
                $path = $request->file('gambar')->storeAs('public/kegiatan', $filenameSimpan);
            }

            $kegiatan = new Kegiatan([
                'judul' => $request->get('judul'),
                'tanggal' => $request->get('tanggal'),
                'link' => $request->get('link'),
                'gambar' => $gambar
            ]);
            $kegiatan->save();
            return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan telah ditambahkan');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function update(Request $request, $id_kegiatan) {
        if (Auth::check()) {
            $rules = [
                'judul' => 'required|string',
                'tanggal' => 'required|date',
                'link' => 'required|string',
            ];
            $messages = [
                'judul.required' => 'Jenis wajib diisi',
                'judul.string' => 'Jenis tidak valid',
                'tanggal.required' => 'Tanggal wajib diisi',
                'tanggal.date' => 'Tanggal tidak valid',
                'link.required' => 'Jenis wajib diisi',
                'link.string' => 'Jenis tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $kegiatan = Kegiatan::find($id_kegiatan);
            if (!$kegiatan) {
                echo "error"; die();
            }

            if ($request->hasFile('gambar')) {
                $filenameWithExt = $request->file('gambar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $filenameSimpan = md5($filename. time()).'.'.$extension;
                $gambar = $filenameSimpan;
                $path = $request->file('gambar')->storeAs('public/kegiatan', $filenameSimpan);
                $kegiatan->gambar = $gambar;
            }

            $kegiatan->judul = $request->get('judul');
            $kegiatan->tanggal = $request->get('tanggal');
            $kegiatan->link = $request->get('link');
            $kegiatan->update();
            return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan telah diperbaharui');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function delete($id_kegiatan) {
        if (Auth::check()) {
            $kegiatan = Kegiatan::find($id_kegiatan);
            if (!$kegiatan) {
                echo "error"; die();
            }
            $kegiatan->delete();
            return redirect('/dashboard/kegiatan')->with('success', 'Data kegiatan telah dihapus');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}