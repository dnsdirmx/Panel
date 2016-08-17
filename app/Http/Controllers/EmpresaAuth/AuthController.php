<?php
namespace App\Http\Controllers\EmpresaAuth;
use Log;
use App\Empresa;

use App\Giro;
use App\Estado;
use App\Ciudad;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/empresa';
    
    protected $guard = 'empresa';

    protected $loginPath = '/empresa-login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'required' => 'El :attribute es necesario',
            'email.unique' => 'El email ya existe',
            'password.min' => 'Es necesario un password de al menos 6 caracteres'
        ];
        return Validator::make($data, [
            'nombre_contacto' => 'required|max:255',
            'name' => 'required|max:255',
            'estado' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'giro' => 'required',
            'email' => 'required|email|max:255|unique:empresas',
            'password' => 'required|confirmed|min:6',

        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Empresa
     */
    protected function create(array $data)
    {
        return Empresa::create([
            'name' => $data['name'],
            'nombre_contacto' => $data['nombre_contacto'],
            'estado' => $data['estado'],
            'ciudad' => $data['ciudad'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'giro_id' => $data['giro'],
            'cod_promotor' => $data['cod_promotor'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        if(Auth::guard('empresa')->check())
            return redirect('empresa');
     
        $giros = Giro::all();
        $estados = Estado::all();

        return view('empresa.registro',['giros' => $giros, 'estados' => $estados]);
    }
    public function empresaLogin()
    {
        if(Auth::guard('empresa')->check())
            return redirect('empresa');
        error_log('Devolviendo la vista del login');
        return view('empresa.login');
    }

    public function empresaLoginPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('empresa')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            error_log('todo bien');
            $user = auth()->guard('empresa')->user();
            return redirect('empresa');
        }
        else{
            return back()->withInput(['email','password'])->withErrors(['form' => 'el email y/o password son invalidos.']);
        }
    }
}