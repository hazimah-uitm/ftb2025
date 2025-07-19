<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function resetPassword($user, $password)
    {

        if (is_null($user->email_verified_at)) {
            // Sekat reset dan redirect dengan mesej
            return redirect()->route('login')->withErrors([
                'email' => 'Akaun anda belum disahkan. Sila semak inbox anda untuk pautan pengesahan atau <a href="' . route('firsttimelogin.form') . '">Klik di sini</a> untuk hantar semula pautan pengesahan.'
            ]);
        }

        $user = User::find($user->id);
        $user->password = bcrypt($password);
        $user->remember_token = Str::random(60);
        $user->save();

        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Kata laluan telah berjaya di set. Sila log masuk menggunakan Emel dan Kata Laluan.');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
            'type' => $request->query('type', 'reset')
        ]);
    }
}
