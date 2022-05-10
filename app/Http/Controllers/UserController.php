<?php

namespace App\Http\Controllers;

use App\Exports\CatperExport;
use App\Models\Sosmed;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.akun');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $akun)
    {

        if ($request->foto == '') {
            $akun = User::where('nik', $akun)->first();
            if ($request->email == $akun->email) {
                $validate = $request->validate([
                    'name' => 'required',
                ]);
                $edit = $akun->update($validate);
            } else {
                $validate = $request->validate([
                    'name' => 'required',
                    'email' => 'required|unique:users'
                ]);
                $edit = $akun->update($validate);
            }
            
        } else {
            $foto = public_path('/') . Auth::user()->foto;
            $default = public_path('/img/default.png');

            // File::delete('/' . Auth::user()->foto);

            $file = $request->file('foto');

            // Mendapatkan Nama File
            $extension = $file->getClientOriginalExtension();
            $name = $request->name;
            $nama = explode(" ", $name);
            $nama_file = join("-", $nama) . "." . $extension;

            // Proses Upload File
            $destinationPath = 'img/akun';
            $file->move($destinationPath, $nama_file);
            $filenameSimpan = $destinationPath . '/' . $nama_file;

            if (file_exists($foto)) {
                if ($foto != $default) {
                    @unlink($foto);
                }
            }

            $akun = User::where('nik', $akun)->first();
            if ($request->email == $akun->email) {
                $validate = $request->validate([
                    'name' => 'required',
                ]);
                $edit = $akun->update($validate);
            } else {
                $validate = $request->validate([
                    'name' => 'required',
                    'email' => 'required|unique:users'
                ]);
                $edit = $akun->update($validate);
            }

            $edit = $akun->update([
                'foto' => $filenameSimpan
            ]);
        }


        if ($edit) {
            //redirect dengan pesan sukses
            return redirect()->route('akun.index')->with('success', 'Akun Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect()->route('akun.index')->with('error', 'Akun Gagal Diupdate');
        }
    }

    public function editNIK(Request $request, User $akun)
    {
        $data = $request->validate([
            'nik' => 'required|unique:users|min:13|max:24',
        ]);

        $edit = $akun->update($data);

        if ($edit) {
            //redirect dengan pesan sukses
            return redirect()->route('akun.index')->with('success', 'NIK Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect()->route('akun.index')->with('error', 'NIK Gagal Diupdate');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $user = User::find($id);

        return view('user.delete', compact('user'));
    }

    public function destroy(User $akun)
    {
        $hapus = $akun->delete();
        $catper = Auth::user()->catper;
        foreach ($catper as $item) {
            $hapus = $item->delete();
        }

        if ($hapus) {
            //redirect dengan pesan sukses
            return redirect()->route('login')->with('success', 'Akun Berhasil Didelete');
        } else {
            //redirect dengan pesan error
            return redirect()->route('login')->with('error', 'Akun Gagal Didelete');
        }
    }
}
