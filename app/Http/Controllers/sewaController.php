<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sewaController extends Controller
{
    public function index(Request $request)
{
    $userId = Auth::id(); 
    //$mobils = Mobil::where('user_id', '!=', $userId)->get();
    $query = Mobil::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;

        $query->where('merek', 'like', "%$search%")
              ->orWhere('no_plat', 'like', "%$search%")
              ->orWhere('model', 'like', "%$search%");
    }

    $mobils = $query->paginate(10); 
    return view('sewaMobil.index', compact('mobils'));
}

public function detailMobilSewa($id)
{
    $mobil = Mobil::findOrFail($id);
    return view('sewaMobil.formSewa',compact('mobil'));
}


public function detailPengembalian($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    return view('sewaMobil.formPengembalian',compact('peminjaman'));
}
 

public function showPeminjaman()
  {
    $userId= Auth::id();
    $peminjamans = Peminjaman::where('user_id',$userId)->get();
    return view('sewaMobil.daftarSewa',compact('peminjamans'));
  }

public function sewa(Request $request, $id)
{
    $mobil = Mobil::findOrFail($id);

    if ($mobil->status) {
        return redirect()->back()->with('error', 'Mobil ini sudah disewa!');
    }
    $totalHarga = (int) str_replace('.', '', $request->input('total_harga'));
    Peminjaman::create([
        'mobil_id' => $mobil->id,
        'user_id' => Auth::id(),
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai, 
        'total_harga'=>$totalHarga
    ]);
    $mobil->status = true;
    $mobil->save();

    return redirect('/listMobil');
}

public function kembali(Request $request, $id)
{
    $mobil = Mobil::findOrFail($id);
    $peminjaman = Peminjaman::where('mobil_id', $id)->first();
    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Mobil ini tidak sedang disewa!');
    }
    $totalHarga = (int) str_replace('.', '', $request->input('total_harga'));
    Pengembalian::create([
        'user_id' => Auth::id(),
        'tanggal_pengembalian' => $request->tanggal_pengembalian,
        'total_biaya' => $totalHarga,
        'total_hari'=>$request->total_hari,
        'peminjaman_id'=>$peminjaman->id
    ]);
    $peminjaman->status = true;
    $peminjaman->save();

    $mobil->status = false;
    $mobil->save();

    return redirect('/listMobil');
}


}
