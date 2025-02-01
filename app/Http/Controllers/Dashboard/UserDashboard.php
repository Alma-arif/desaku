<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Models\User;


class UserDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 2;
        $search = request('search');
        // $data =  User::with('jabatan')->paginate($max_data);
        // return view('dashboard.UserDashboard', compact('data'));

        if ($search) {
            $data = User::with('jabatan')
                ->when($search, function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('role', 'like', "%{$search}%")
                            ->orWhere('alamat', 'like', "%{$search}%")
                            ->orWhere('telepon', 'like', "%{$search}%");
                    })->orWhereHas('jabatan', function ($query) use ($search) {
                        $query->where('nama_jabatan', 'like', "%{$search}%");
                    });
                })->paginate($max_data)->appends(request()->query());
        } else {
            $data =  User::with('jabatan')->paginate($max_data);
        }

      $jabatan =  Jabatan::all();

        // dd($data);
        return view('dashboard.users.UserDashboard', compact('data', 'jabatan'));
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'jabatan' => 'required',
            'telepon' => 'required|min:11',

        ]);

        if ($request['role'] == 1) {
            $role = 'admin';
        }else if ($request['role'] == 0) {
            $role = 'user';
        }


        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' =>  bcrypt($validated['password']),
                'role' => $role,
                'id_jabatan' => $validated['jabatan'],
                'alamat' => $request['alamat'],
                'telepon' => $validated['telepon'],

            ]
        );

        return redirect()->route('UserDashboard')->with('success', 'Data berhasil ditambahkan!');
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
            'name' => 'required|string|max:100',
            // 'email' => 'required|email',
            'role' => 'required',
            'jabatan' => 'required',
            'telepon' => 'required|min:11',

        ]);


        if ($request['role'] == 1) {
            $role = 'admin';
        }else if ($request['role'] == 0) {
            $role = 'user';
        }

        $data = [
            'name' => $validated['name'],
            'role' =>  $role,
            'id_jabatan' => $validated['jabatan'],
            'alamat' => $request['alamat'],
            'telepon' => $validated['telepon'],
        ];

        User::where('id', $id)->update($data);
        return redirect()->route('UserDashboard')->with('success', 'Data berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('UserDashboard')->with('success', 'Data berhasil dihapus!');

    }
}
