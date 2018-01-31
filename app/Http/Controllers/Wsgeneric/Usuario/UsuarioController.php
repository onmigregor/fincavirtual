<?php namespace App\Http\Controllers\Wsgeneric\Usuario;

use App\User;
use Curl;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class UsuarioController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	
	protected $loginPath = '/';
	 /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
		$this->middleware('jwt.auth', ['except' => ['postLogin']]);
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
            'login' => 'required|max:255|unique:usuario',
            'clave' => 'required|max:255|confirmed',
            'captcha' => 'required',
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
	
	
	public function home()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('home');
        }else{
			// Si no hay sesión activa mostramos el formulario
			Session::flash('alert-success', 'Bienvenido a Sistema Orinoco');
			return redirect()->intended('Usuario/login');
		}
    }
	public function redirectPath()
	{
		return route('Wsgeneric/Usuario/home');
	}
	
	/**
	  * Get the login
	  *
	  * @return string
	  */
	public function getLogin()
    {
		return view('Wsgeneric/Usuario/login');
    }
	
	/**
     * POST Show the application login form.
     *
     * @return Response
     */

	public function postLogin(Request $request){
//dd("entro aqui");
		//session(['logins' => $request->get('login')]);
		
		// credenciales para loguear al usuario
        $credentials = $request->only('login', 'clave');
		$login=$request->login;
		$clave=$request->clave;
		$captcha=$request->captcha;
		$response = Curl::to('http://10.0.10.13/baaszoom/public/getInfoUsuario')
	   		->withData( array( 'login' => $login,'clave' => $clave ))
	    	->get();  
		$usuarios=json_decode($response, true);
// and you can continue to chain methods
//$user = JWTAuth::parseToken()->authenticate($response);
/*$user = JWTAuth::setToken($response);
		dd($user);*/
        try {
            // si los datos de login no son correctos
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // todo bien devuelve el token
        return response()->json(compact('token'));
		
		
		
		/*
		
		// Variables de login y clave para enviar al webservcies de Usuario
		$login=$request->login;
		$clave=$request->clave;
		$captcha=$request->captcha;
		
		$response = Curl::to('http://10.0.10.13/baaszoom/public/getInfoUsuario')
	   		->withData( array( 'login' => $login,'clave' => $clave ))
	    	->get();  
		$usuarios=json_decode($response, true);
		//$request->session()->put('logins', $response);
		$request->session()->save();
		//$request->session()->flush();
		dd($request->session()->all());
		
		if(!empty($usuarios)){
			//consulta a BD de login y clave
			//$auth = (object)$usuarios;
			//$auth = Auth::login($usuarios);
			//$auth = Auth::onceBasic() ?: $next($response);
			$codusuario=$usuarios['entidadRespuesta'][0]['codusuario'];
			Auth::$usuarios;
			$auth =Auth;//::loginUsingId($codusuario);
			print_r($auth);
			//validacion de captcha
			$rules =  array('captcha' => ['required', 'captcha']); 
			//$rules = ['captcha' => 'required|captcha'];
				//$validator = Validator::make([ 'captcha' => $request->captcha],$rules, [ 'captcha' => 'C&oacute;digo de Validaci&oacute;n incorrecto.' ]); 
				//print_r($validator);
				//if ($validator->passes()) { 
				
				if($auth){
					Auth::login($auth);
					Session::flash('alert-success', 'Bienvenido al Sistema Orinoco '. Auth::user()->nombre);
					return redirect()->intended($this->redirectPath())->withErrors($validator)->withInput();
				}
				else
				{
					$rules	=	[
						'login'	=>	'required',
						'clave'	=>	'required',
					];
					$messages	=	[
						'login.required' =>	'Campo Requerido',
						'clave.required' =>	'Campo Requerido',
					];
						$validator	=	Validator::make($request->all(), $rules, $messages);
						return redirect('Wsgeneric/Usuario/login')
								->withErrors($validator)
								->withInput()
								->with('alert-danger', 'Error al iniciar sesi&oacute;n. Verifique Login y Clave');
				}
			
			} else { 
				//captcha incorrecto
				return Redirect::back()->withErrors($validator)->withInput();//Request::except("clave")
			} 
		}else{
			return redirect('Wsgeneric/Usuario/login')
					->withInput()
					->with('alert-danger', 'Clave y/o Login incorrectos. Verifique');
		}
		*/
	}
	 
	/**
     * cierre de session.
     *
     * @return logout
     */
	
	public function getLogout()
    {
        // Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('Usuario/login')->with('alert-danger', 'Cierre de Sesi&oacute;n exitoso.');
    }
	
	/**
     * Refresh catpcha.
     *
     * @return new captcha
     */
	public function refereshCapcha(){
		return captcha_img('flat');
	}
	

	
}
