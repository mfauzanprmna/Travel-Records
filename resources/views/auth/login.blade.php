<!doctype html>
<html lang="en">

<head>
    @if (request()->is('login'))
    <title>Login</title>
    @elseif(request()->is('register'))
    <title>Register</title>
    @endif
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section>
        <div class="welcome">
            <h3>Selamat Datang di Travel Records</h3>
        </div>
    @if (request()->is('login'))
            <div class="contentBx">
                <div class="formBx">
                    <h2>Login</h2>
                    @if (session()->has('gagal'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('gagal') }}
                        </div>
                    @endif
                    <form method="POST" {{ route('sendLink') }}>
                        @csrf
                        <div class="inputBx">
                            <label for="nik">NIK</label>
                            <input type="number" class="@error('nik') is-invalid @enderror" name="nik" id="nik"
                                placeholder="NIK">
                            @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="inputBx">
                            <label for="name">Nama Lengakp</label>
                            <input type="text" class="@error('name') is-invalid @enderror" name="name" id="name"
                                placeholder="Nama Lengkap">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="remember">
                            <label for="">
                                <input type="checkbox" name="remember" id="" value="1">
                                Remember Me
                            </label>
                        </div>
                        <div class="inputBx">
                            <input type="submit" value="Login" name="" id="">
                        </div>
                        <div class="inputBx">
                            <p>Don`t have a account? <a href="{{ route('register') }}">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="imgBx">
                <img src="{{ asset('img/background.jpg') }}" alt="">
            </div>
    @elseif(request()->is('register'))
            <div class="imgBx">
                <img src="{{ asset('img/background.jpg') }}" alt="">
            </div>
            <div class="contentBx">
                <div class="formBx">
                    <h2>Register</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="inputBx">
                            <span>NIK</span>
                            <input type="number" class="@error('nik') is-invalid @enderror" name="nik" id=""
                                :value="old('nik')" placeholder="NIK">
                            @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="inputBx">
                            <span>Nama</span>
                            <input type="text" class="@error('name') is-invalid @enderror" name="name" id=""
                                :value="old('name')" placeholder="Nama Lengkap">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="inputBx">
                            <span>Email</span>
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" id=""
                                :value="old('email')" placeholder="Email">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="inputBx">
                            <input type="submit" value="Register" name="" id="">
                        </div>
                        <div class="inputBx">
                            <a href="{{ route('login') }}">Already Registed?</a></p>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @if (session()->has('success') || session()->has('error'))
        @include('sweetalert::alert')
    @endif
</body>

</html>
