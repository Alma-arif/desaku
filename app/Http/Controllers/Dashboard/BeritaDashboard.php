<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 2;
        $search = request('search');


        if ($search) {
            $statusValue = null;
            if (strtolower($search) === 'aktif') {
                $statusValue = 1;
            } elseif (strtolower($search) === 'non aktif') {
                $statusValue = 0;
            }

            $data = Berita::with(['user', 'berita_kategori'])
                ->when(!empty($search), function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%")
                            ->orWhere('isi', 'like', "%{$search}%")
                            ->orWhere('id_user', 'like', "%{$search}%")
                            ->orWhere('id_kategory', 'like', "%{$search}%")
                            ->orWhere('image', 'like', "%{$search}%")
                            ->orWhereHas('user', function ($query) use ($search) {
                                $query->where('name', 'like', "%{$search}%");
                            })
                            ->orWhereHas('berita_kategori', function ($query) use ($search) {
                                $query->where('judul', 'like', "%{$search}%");
                            });
                    });
                })
                ->when($statusValue !== null, function ($query) use ($statusValue) {
                    $query->where('status', $statusValue);
                })
                ->paginate($max_data)
                ->appends(request()->query());
        } else {
            $data = Berita::with(['user', 'berita_kategori'])
            ->orderBy('created_at', 'desc') // Menampilkan berita terbaru terlebih dahulu
            ->paginate($max_data)
            ->appends(request()->query());
        }

        $kategori = BeritaKategori::all();
// dd($data);
        return view('dashboard.berita.BeritaDashboard', compact('data', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita' => 'required|integer',
            'status' => 'required',
            'isi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('berita', 'public');

        if ($request['status'] == 'aktif') {
            $status = 1;
        } else if ($request['status'] == 'no_aktif') {
            $status = 0;
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_user' => Auth::id(),
            'id_kategory' => $request->kategori_berita,
            'status' => $status,
            'image' => $imagePath,
        ]);
        return redirect()->route('BeritaDashboard')->with('success', 'Berita berhasil dibuat!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|integer',
            'status' => 'required|in:0,1',
            'isi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            $imagePath = $request->file('image')->store('berita', 'public');
        } else {
            $imagePath = $berita->image;
        }

        $berita->judul = $request->judul;
        $berita->id_kategory = $request->id_kategori;
        $berita->status = $request->status;
        $berita->isi = $request->isi;
        $berita->image = $imagePath;


        $berita->save();

        return redirect()->route('BeritaDashboard')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        // Hapus data dari database
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
