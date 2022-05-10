<?php

namespace App\Exports;

use App\Models\Catper;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CatperExport implements FromView
{
    public function view(): View
    {
        return view('user.catper.table', [
            'catpers' => Catper::select('tanggal', 'waktu', 'lokasi', 'suhu')->where('user_id', Auth::user()->id)->get()
        ]);
    }
}
