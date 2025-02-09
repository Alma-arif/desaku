<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanDashboard extends Controller
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

            $data = Jabatan::where('nama_jabatan', 'like', '%' . $search . '%')
                ->orWhere('tingkat_jabatan', 'like', '%' . $search . '%')
                ->orWhere('keterangan_jabatan', 'like', '%' . $search . '%')
                ->when($statusValue !== null, function ($query) use ($statusValue) {
                    return $query->orWhere('status', $statusValue);
                })
                ->paginate($max_data)
                ->withQueryString();
        } else {
            $data =  Jabatan::paginate($max_data);
        }
        return view('dashboard.jabatan.JabatanDashboard', compact('data'));
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
            'nama_jabatan' => 'required',
            'tingkat_jabatan' => 'required',
            'status' => 'required',
        ]);

        if ($request['status'] == 'aktif') {
            $status = 1;
        } else if ($request['status'] == 'no_aktif') {
            $status = 0;
        }

        Jabatan::create(
            [
                'nama_jabatan' => $validated['nama_jabatan'],
                'tingkat_jabatan' => $validated['tingkat_jabatan'],
                'keterangan_jabatan' =>  $request['keterangan_jabatan'],
                'status' => $status,

            ]
        );
        return redirect()->route('JabatanDashboard')->with('success', 'Data berhasil ditambahkan!');
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
            'nama_jabatan' => 'required',
            'tingkat_jabatan' => 'required',
            'status' => 'required',
        ]);

        if ($request['status'] == 'aktif') {
            $status = 1;
        } else if ($request['status'] == 'no_aktif') {
            $status = 0;
        }

        Jabatan::findOrFail($id)->update(
            [
                'nama_jabatan' => $validated['nama_jabatan'],
                'tingkat_jabatan' => $validated['tingkat_jabatan'],
                'keterangan_jabatan' =>  $request['keterangan_jabatan'],
                'status' => $status,

            ]
        );
        return redirect()->route('JabatanDashboard')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Jabatan::findOrFail($id)->delete();
        return redirect()->route('JabatanDashboard')->with('success', 'Data berhasil dihapus!');
    }
}
