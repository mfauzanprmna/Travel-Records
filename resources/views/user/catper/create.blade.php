@extends('template.app')
@section('title', 'Create | Travel Records')
@section('main')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Catatan Perjalanan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('catper.index') }}">Catatan Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('catper.create') }}">Create</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tambah Data</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('catper.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}" placeholder="Masukkan No Induk">

                                <!-- error message untuk tanggal -->
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Waktu</label>
                                <input type="time" class="form-control @error('waktu') is-invalid @enderror" name="waktu"
                                    value="{{ old('waktu') }}" placeholder="Masukkan Nama Siswa">

                                <!-- error message untuk waktu -->
                                @error('waktu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                    value="{{ old('lokasi') }}" placeholder="Masukkan Lokasi">

                                <!-- error message untuk lokasi -->
                                @error('lokasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Suhu Tubuh</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('suhu') is-invalid @enderror"
                                        id="datepicker" name="suhu" value="{{ old('suhu') }}"
                                        placeholder="Masukkan Suhu Tubuh">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">&#8451;</span>
                                    </div>
                                </div>

                                <!-- error message untuk suhu -->
                                @error('suhu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('catper.index') }}">
                                <button type="button" class="btn btn-md btn-success">Back</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
