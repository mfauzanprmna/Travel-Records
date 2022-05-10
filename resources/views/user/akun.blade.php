@extends('template.app')
@section('title', 'Akun | ' . Auth::user()->name)

@section('main')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{ Auth::user()->name }}</h4>
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
                    <a href="{{ route('catper.index') }}">Update Akun</a>
                </li>
            </ul>
        </div>
        <div class="card border-0 shadow rounded">
            <div class="card-body kekanan">
                <form action="{{ route('akun.update', Auth::user()->nik) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group d-flex justify-content-center align-items-center h-100">
                                <div class="text-center">
                                    <label class="">
                                        <h3>Foto</h3>
                                    </label>
                                    <div class="input-file input-file-image">
                                        <img class="img-upload-preview m-auto" width="200" height="200"
                                            src="{{ asset('/' . Auth::user()->foto) }}" alt="preview"
                                            style="border-radius: 50%">
                                        <input type="file" class="form-control form-control-file" id="uploadImg" name="foto"
                                            accept="image/*">
                                        <label for="uploadImg" class="btn btn-primary btn-round btn-lg mt-3"><i
                                                class="fa fa-file-image"></i> Upload a Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4 class="fw-bold">Akun</h4>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#nik">Edit
                                    NIK</button>
                            </div>

                            <div class="form-group">
                                <label class="">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" placeholder="Nama Lengkap">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" placeholder="Email">

                                <!-- error message untuk name -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-action text-end">
                        <button type="submit" class="btn btn-md btn-primary">Update Akun</button>
                        <a data-toggle="modal" id="smallButton" data-target="#smallModal"
                            data-attr="{{ route('delete.akun', Auth::user()->id) }}" title="Delete Project">
                            <button type="button" class="btn btn-md btn-danger">Delete Akun</button>
                        </a>
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="btn btn-md btn-success">Back</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="nik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit NIK</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('edit.nik', Auth::user()->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="nik">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('name', Auth::user()->nik) }}" placeholder="NIK">

                            <!-- error message untuk name -->
                            @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            $('body').css('overflow', 'hidden')
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $(document).ready(function() {
            $('.close').click(function() {
                $('.modal-backdrop').css('display', 'none');
                $('body').css('overflow', 'visible')
            });
        });
    </script>
    @if (session()->has('success') || session()->has('error'))
        @include('sweetalert::alert')
    @endif
@endsection
