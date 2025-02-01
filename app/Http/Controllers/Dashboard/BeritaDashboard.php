<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

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

            $data = Berita::with(['user', 'kategori_berita'])
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
                            ->orWhereHas('kategori_berita', function ($query) use ($search) {
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
            $data = Berita::with(['user', 'kategori_berita'])
            ->orderBy('created_at', 'desc') // Menampilkan berita terbaru terlebih dahulu
            ->paginate($max_data)
            ->appends(request()->query());
        }

        return view('dashboard.berita.BeritaDashboard', compact('data'));
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
        //
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
