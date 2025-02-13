<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArsipDokumen;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $max_data = 2;
        $search = request('search');

        if ($search) {
            $data = Dokumen::with('user')->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('file_name', 'like', "%{$search}%")
                    ->orWhere('file_path', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%");
                })->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })->paginate($max_data)->appends(request()->query());
        } else {
            $data = Dokumen::with('user')->paginate($max_data);
        }
        return view('dashboard.dokumen.DokumenDashboard', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('dokumen', 'local');
        $fileName = $request->file('file')->getClientOriginalName();

        Dokumen::create([
            'judul' => $request->judul,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
            'status' => 'Aktif',
        ]);

        return redirect()->route('DokumenDashboard')->with('success', 'Dokumen berhasil diunggah.');
    }

    public function archive($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Pindahkan ke arsip
        ArsipDokumen::create([
            'judul' => $dokumen->judul,
            'file_name' => $dokumen->file_name,
            'file_path' => $dokumen->file_path,
            'user_id' => $dokumen->user_id,
        ]);

        // Hapus dari dokumen aktif
        $dokumen->delete();

        return redirect()->route('DokumenDashboard')->with('success', 'Dokumen berhasil diarsipkan.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        Storage::disk('local')->delete($dokumen->file_path);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

}
