<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class mobilController extends Controller
{
    public function index(Request $request)
{
    $query = Mobil::where('user_id', Auth::id()); 

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('merek', 'like', "%$search%")
              ->orWhere('no_plat', 'like', "%$search%")
              ->orWhere('model', 'like', "%$search%");
        });
    }

    $mobils = $query->paginate(10); 
    return view('mobil.index', compact('mobils'));
}

    public function create()
    {
        return view('mobil.formCreate');
    }

    
    public function store(Request $request)
    {
        

        $request->validate([
            'merek' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'no_plat' => 'required|string|max:255|unique:mobils',
            'tarif_sewa_per_hari' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $fotoPath = null;
        if ($request->hasFile('photo')) {
            $fotoPath = $request->file('photo')->store('foto_mobil', 'public');
        }

        Mobil::create([
            'merek' => $request->merek,
            'model' => $request->model,
            'no_plat' => $request->no_plat,
            'user_id'=> Auth::id(),
            'tarif_sewa_per_hari' => $request->tarif_sewa_per_hari,
            'photo' => $fotoPath,
        ]);

        return redirect('/mobil');
    }

    /**
     * Menampilkan form edit mobil.
     */
    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('mobil.formUpdate', compact('mobil'));
    }

    /**
     * Memperbarui data mobil.
     */
    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

    $request->validate([
        'merek' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'no_plat' => "required|string|max:255|unique:mobils,no_plat,$id",
        'tarif_sewa_per_hari' => 'required|numeric|min:0',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        if ($mobil->photo) {
            Storage::disk('public')->delete($mobil->photo); 
        }
        $mobil->photo = $request->file('photo')->store('foto_mobil', 'public');
    }

    $mobil->merek = $request->input('merek');
    $mobil->model = $request->input('model');
    $mobil->no_plat = $request->input('no_plat');
    $mobil->tarif_sewa_per_hari = $request->input('tarif_sewa_per_hari');
    $mobil->save();

    return redirect('/mobil')->with('success', 'Data mobil berhasil diperbarui.');
    }

    /**
     * Menghapus data mobil.
     */
    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto); 
        }

        $mobil->delete();

        return redirect('/mobil');
    }
}
