<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BeritaKategori;
use Illuminate\Http\Request;

class BeritaKategoriDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 10;
        $search = request('search');

        if ($search) {
            $statusValue = null;
            if (strtolower($search) === 'aktif') {
                $statusValue = 1;
            } elseif (strtolower($search) === 'no aktif') {
                $statusValue = 0;
            }

            $data = BeritaKategori::where('judul', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%')
                // ->when($statusValue !== null, function ($query) use ($statusValue) {
                //     return $query->orWhere('status', $statusValue);
                // })
                ->paginate($max_data)
                ->withQueryString();
        } else {
            $data =  BeritaKategori::paginate($max_data);
        }
        return view('dashboard.BeritaKategori.BeritaKategoriDashboard', compact('data'));
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
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        BeritaKategori::create(
            [
                'judul' => $validated['nama'],
                'keterangan' =>  $request['keterangan'],
            ]
        );
        return redirect()->route('BeritaKategoriDashboard')->with('success', 'Data berhasil ditambahkan!');
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
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        BeritaKategori::findOrFail($id)->update(
            [
                'judul' => $validated['nama'],
                'keterangan' =>  $request['keterangan'],
            ]
        );
        return redirect()->route('BeritaKategoriDashboard')->with('success', 'Data berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BeritaKategori::findOrFail($id)->delete();
        return redirect()->route('BeritaKategoriDashboard')->with('success', 'Data berhasil dihapus!');
    }
}
