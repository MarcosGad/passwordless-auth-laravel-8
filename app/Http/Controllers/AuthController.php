<?php
namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Models\User;
use App\Mail\LoginMail;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
        $this->middleware('auth')->only(['logout', 'dashboard']);
    }

    
    public function registerForm()
    {
        return view('register');
    }

    
    public function register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
        ]);

        $token = Str::random(30);

        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->email_verified = '0';
        $user->token = $token;
        $user->save();

        Mail::to($input['email'])->send(new RegisterMail($token));

        return redirect()->back()->with('success', 'Verification mail sent, please check your inbox.');
    }

    
    public function verify(Request $request)
    {
        $input = $request->validate([
            'token' => 'required|string',
        ]);

        $user = User::where('token', $input['token'])
            ->where('email_verified', '0')
            ->first();

        if ($user != null) {
            User::where('token', $input['token'])
                ->update([
                    'email_verified' => '1',
                    'token' => ''
                ]);

            Auth::login($user);
                        
            return redirect()->route('dashboard')->with('success', 'You are successfully registered.');
        }

        return redirect()->back()->with('error', 'Verification link is not valid.');
    }

   
    public function loginForm()
    {
        return view('login');
    }

    
    public function sendLink(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $input['email'])
            ->where('email_verified', '1')
            ->first();

        if ($user != null) {
            $token = Str::random(30);

            User::where('email', $input['email'])
                ->where('email_verified', '1')
                ->update(['token' => $token]);
            
            Mail::to($input['email'])->send(new LoginMail($token));
            
            return redirect()->back()->with('success', 'Login link sent, please check your inbox.');
        }

        return redirect()->back()->with('error', 'Email is not registered.');
    }

    
    public function login(Request $request)
    {
        $input = $request->validate([
            'token' => 'required|string',
        ]);

        $user = User::where('token', $input['token'])
            ->where('email_verified', '1')
            ->first();

        if ($user != null) {
            User::where('token', $input['token'])
                ->where('email_verified', '1')
                ->update(['token' => '']);

            Auth::login($user);
            
            return redirect()->route('dashboard')->with('success', 'You are successfully logged in.');
        }

        return redirect()->back()->with('error', 'Login link is not valid.');
    }

   
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        \Session::flush();

        return redirect()->route('loginForm')->with('success', 'you are successfully logged out.');
    }

   
    public function dashboard()
    {
        return view('dashboard');
    }
}