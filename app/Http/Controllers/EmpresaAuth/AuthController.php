<?php
namespace App\Http\Controllers\EmpresaAuth;
use Log;
use App\Empresa;
use App\Giro;
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
        return Validator::make($data, [
            'name' => 'required|max:255',
            'ciudad' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'giro' => 'required',
            'email' => 'required|email|max:255|unique:empresas',
            'password' => 'required|confirmed|min:6',

        ]);
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

            'ciudad' => $data['ciudad'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'giro_id' => $data['giro'],
            'cod_promotor' => $data['codpromotor'],
            
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $giros = Giro::all();
        return view('empresa.registro',['giros' => $giros]);
    }
    public function empresaLogin()
    {
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
        }else{
            return back()->withInput(['email','password'])->withErrors(['form' => 'el email y/o password son invalidos.']);
        }
    }
}