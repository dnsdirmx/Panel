<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/embajador';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function embajadorLogin()
    {
        return view('embajador.embajadorLogin');
    }

    public function embajadorLoginPost(Request $request)
    {
        error_log('embajador valida campos');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        error_log('embajador  envia attemp');
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            error_log('embajador todo bien');
            $user = auth()->user();
            dd($user);
        }else{
            error_log('embajador todo mal :(');
            return back()->with('error','el email y/o password son invalidos.');
        }
    }
}