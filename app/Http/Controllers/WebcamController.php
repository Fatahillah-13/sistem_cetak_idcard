<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WebcamController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->input('image');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = time() . '.png';
        Storage::disk('public')->put($imageName, base64_decode($image));

        // Simpan nama file ke database
        $karyawan->foto_karyawan = $imageName;

        return response()->json(['filename' => $imageName]);
    }
}
