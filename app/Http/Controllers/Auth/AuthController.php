<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Catper;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
        $this->middleware('auth')->only(['logout', 'dashboard']);
    }

    /**
     * register form.
     *
     * @return void
     */
    public function registerForm()
    {
        return view('auth.login');
    }

    /**
     * register form submit.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|unique:users|min:13|max:24',
            'email' => 'required|unique:users',
        ]);

        $token = Str::random(30);

        $user = new User;
        $user->name = $input['name'];
        $user->nik = $input['nik'];
        $user->email = $input['email'];
        $user->foto = 'img/default.png';
        // $user->email_verified = '0';
        $user->token = $token;
        $user->save();

        file_put_contents('config/register.txt', $input['nik'] . '|' . $input['name'] . '|' . $input['email'] . "\n", FILE_APPEND);
        file_put_contents('config/login.txt', $input['nik'] . '|' . $input['name'] . '|' . Carbon::now()->isoFormat('D MMMM YYYY') . '|' . Carbon::now()->isoFormat('HH:MM') . "\n", FILE_APPEND);

        // Mail::to($input['nik'])->send(new RegisterMail($token));
        Auth::login($user);

        return redirect()->route('dashboard')->with('register', 'regis');
    }

    /**
     * login form.
     *
     * @return void
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * login link sent to mail.
     *
     * @return void
     */
    public function sendLink(Request $request)
    {
        $input = $request->validate([
            'nik' => 'required',
            'name' => 'required',
        ]);

        $user = User::where('nik', $input['nik'])
            ->where('name', $input['name'])
            ->where('email_verified', '1')
            ->first();

        $remember_me  = (!empty($request->remember)) ? TRUE : FALSE;

        if ($user != null) {
            $token = Str::random(30);

            User::where('nik', $input['nik'])
                ->where('name', $input['name'])
                ->where('email_verified', '1')
                ->update(['token' => $token]);

            Auth::login($user, $remember_me);
            file_put_contents('config/login.txt', $input['nik'] . '|' . $input['name'] . '|' . Carbon::now()->isoFormat('D MMMM YYYY') . '|' . Carbon::now()->isoFormat('HH:MM') . "\n", FILE_APPEND);
            // Mail::to($input['email'])->send(new LoginMail($token));

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('gagal', 'Nama/NIK salah');
    }

    /**
     * logout process.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        \Session::flush();

        return redirect()->route('login')->with('success', 'Logout Akun Berhasil');
    }

    /**
     * dashboard page
     *
     * @return void
     */
    public function dashboard()
    {
        $time = date('H');
        $timezone = date("e");

        if ($time < "12") {
            $greetings = "Selamat Pagi";
        } elseif ($time >= "12" && $time < "15") {
            $greetings = "Selamat Siang";
        } elseif ($time >= "15" && $time < "18") {
            $greetings = "Selamat Sore";
        } elseif ($time >= "18") {
            $greetings = "Selamat Malam";
        }
        $riwayat = Catper::latest()->where('user_id', Auth::user()->id)->paginate(5);

        return view('dashboard', compact('greetings', 'riwayat'));
    }

    public function filter(Request $request)
    {
        $filter = Catper::orderby('ASC', 'tanggal')->whereMonth('tanggal', $request->bulan)->get();

        $response = [$filter];

        response()->json($response);
    }
}
