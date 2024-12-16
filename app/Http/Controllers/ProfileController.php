<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
   /*  public function index()
    {
        return view('profile');
    }  */
    public function index()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan; // Ambil data pelanggan yang terkait

        return view('profile', [
            'user' => $user,
            'nm_pelanggan' => $pelanggan ? $pelanggan->nama : null,
        ]);
    }

    public function updateAvatar(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Menyimpan file avatar dan mengambil path
            $path = $request->file('avatar')->store('avatars', 'public');

            // Menyimpan path avatar ke kolom url_img di database
            $user->url_img = $path;
        } else {
            // Jika tidak ada file yang diupload, set kolom url_img ke null atau gambar default
            $user->url_img = null; // Atau simpan gambar default jika diinginkan
        }

        $user->save();
        // Mengembalikan respons JSON dengan URL baru avatar
        return redirect()->route('my-account')->with('success', 'Foto berhasil diperbarui');
        /* return response()->json([
            'avatar_url' => Storage::url($path),
        ]); */

       /*  return response()->json([
            'avatar_url' => $user->url_img ? Storage::url($user->url_img) : asset('storage/avatars/default.png'),
        ]); */
    }

}
