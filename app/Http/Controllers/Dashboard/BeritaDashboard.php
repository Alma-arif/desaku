<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'id_kategori' => $request->kategori_berita,
            'status' => $status,
            'isi' => $request->isi,
            'image' => $imagePath,
            'id_user' => Auth::id(),
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
