@extends('template.app')
@section('title', 'Dashboard')

@section('main')
    <style>
        .pilih {
            transition: .5s;
        }

        .pilih:hover {
            transform: scale(1.03);
            transition: .5s;
            box-shadow: 9px 9px 5px 0 rgba(0, 0, 0, 0.03);
        }

    </style>

    <div class="panel-header " style="background-image: linear-gradient(#7a74fc, #6C63FF);">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard </h2>
                    <h5 class="text-white op-7 mb-2">{{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="card full-height">
            <div class="card-body">
                <div>
                    <h3 class="pb-2 fw-bold">{{ $greetings }}, {{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('catper.index') }}" style="text-decoration:none; color:inherit;">
                    <div class="pilih card full-height">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img src="{{ asset('img/Notes_Monochromatic.png') }}" alt="" width="50%">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-title">Catatan Perjalanan</div>
                                    <p>Tempat untuk melihat, menambahkan dan mengupdate data Catatan Perjalanan selama
                                        Pandemi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('akun.index') }}" style="text-decoration:none; color:inherit;">
                    <div class="pilih card full-height">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img src="{{ asset('img/User interface_Monochromatic.png') }}" alt="" width="50%">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-title">Update Akun</div>
                                    <p>Tempat untuk meengubah data Akun</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="container">
            <h1>Riwayat Catatan Perjalanan</h1>
            @foreach ($riwayat as $item)
                <div class="card full-height">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <h3>Lokasi : {{ $item->lokasi }}</h3>
                            <h6>Suhu Tubuh : {{ $item->suhu }} &#8451;</h6>
                        </div>
                        <h5 class="op-7">
                            {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                            {{ $item->waktu }}</h5>
                    </div>
                </div>
            @endforeach
            <div class="pagination justify-content-center">
                {{ $riwayat->links() }}
            </div>
        </div>

    </div>
@endsection
