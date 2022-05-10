<?php

namespace App\Http\Controllers;

use App\Exports\CatperExport;
use App\Models\Catper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class CatperController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $catpers = Catper::latest()->where('user_id', Auth::user()->id)->get();

        return view('user.catper.index', compact('catpers'));
    }

    public function create()
    {
        return view('user.catper.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'suhu' => 'required'
        ]);

        $catper = Catper::create([
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'suhu' => $request->suhu
        ]);


        if ($catper) {
            //redirect dengan pesan sukses
            return redirect()->route('catper.index')->with('success', 'Data Berhasil Disimpan');
        } else {
            //redirect dengan pesan error
            return redirect()->route('catper.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function edit($id)
    {
        $catper = Catper::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($catper) {
            return view('user.catper.edit', compact('catper'));
        } else {
            return back()->with('editError', 'Data tidak dapat ditemukan');
        }
        
    }

    public function update(Request $request, Catper $catper)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'suhu' => 'required'
        ]);

        $edit = $catper->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'suhu' => $request->suhu
        ]);

        if ($edit) {
            //redirect dengan pesan sukses
            return redirect()->route('catper.index')->with('success', 'Data Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect()->route('catper.index')->with('error', 'Data Gagal Diupdate');
        }
    }

    public function delete($id)
    {
        $catper = Catper::find($id);

        return view('user.catper.delete', compact('catper'));
    }

    public function destroy(Catper $catper)
    {
        $hapus = $catper->delete();

        if ($hapus) {
            //redirect dengan pesan sukses
            return redirect()->route('catper.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            //redirect dengan pesan error
            return redirect()->route('catper.index')->with('error', 'Data Gagal Dihapus');
        }
    }

    public function export()
    {
        return Excel::download(new CatperExport(), 'catper-' . Carbon::now()->isoFormat('D-MMMM-YYYY') . '.xlsx');
        // return new CatperExport;
    }

    public function pdf()
    {
        $catper = Catper::all()->where('user_id', Auth::user()->id);

        $pdf = PDF::loadView('user.catper.pdf', ['catper' => $catper]);
        return $pdf->stream();
    }
}
