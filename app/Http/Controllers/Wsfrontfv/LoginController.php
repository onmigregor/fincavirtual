<?php

/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 09/03/2017
 *    Clase: ConsultaController.php
 ************************************************/

namespace App\Http\Controllers\Wsfrontfv;
use Auth;
use Curl;
use View;
use Input;
use Session;
use Response;
use File;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ConsumirWS;
//use App\Http\Controllers\LoginController;

class LoginController extends Controller
{

    public $restful = true;
    public function Login()
    {
        if(Auth::user())
        {
            return redirect()->route('principal');
        }
        //mostramos la vista views/login/index.blade.php pasando un título
        //return redirect()->route('login');
        Auth::logout();
        Session::flush();
        return view('fincavirtual/Login');
    }

    public function postlogin(Request $request)
    {

        $params=$request->all();
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'email' => $params['login'],
            'password'=> $params['claveenc']
        );
        //dd($userdata);
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata))
        {
            $user = Auth::user();
            Session::put('usuario', $user->nombre);
            Session::put('email', $user->email);
            Session::put('rol', $user->rol);
            //dd(Session::all());    
            return redirect()->route('principal');
 
        }
        else
        {
             //dd("no entro");

        //en caso contrario mostramos un error
        return redirect()->route('login');
        }
    }
    public function logout()
    {
        Auth::logout();// RECORDAR QUE SE COMENTO LA LIENA 494 DE \vendor\laravel\framework\src\Illuminate\Auth
        Session::flush();
        return view('fincavirtual/Login');
    }
}


/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 09/03/2017
 *    Clase: ConsultaController.php
 ************************************************/
/*
namespace App\Http\Controllers\Wsfrontfv;
use Auth;
use Curl;
use View;
use Input;
use Session;
use Response;
use File;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ConsumirWS;
//use App\Http\Controllers\LoginController;

class LoginController extends Controller
{

    public $restful = true;
    public function Login()
    {
        if(Auth::user())
        {
            return View::make('fincavirtual/principal');;
        }
        //mostramos la vista views/login/index.blade.php pasando un título
        return View::make('fincavirtual/Login')->with('title','Login');
    }

    public function postlogin(Request $request)
    {

$params=$request->all();
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'email' => $params['login'],
            'password'=> $params['claveenc']
        );
        //dd($userdata);
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata))
        {
$user = Auth::user();
            dd($user);
 
            return View::make('fincavirtual/principal');
 
        }
        else
        {
             //dd("no entro");

        //en caso contrario mostramos un error
        return View::make('fincavirtual/Login');
        }
    }
}*/
?>