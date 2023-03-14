<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Mail\CodCorreo;
use App\Http\Controllers\CodController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('Auth.login');
    }
    public function register()
    {
        return view('Auth.register');
    }
    public function home()
    {
        return view('Auth.home');
    }


    public function ingresar(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $params = $request->only('email','password');
        if(Auth::attempt($params)){
            $persona = User::where("email", "=", $request->email)->first();
            $cod = rand(1000,9999);

            $codController = app(CodController::class);
            $codController->saveCodEmail($persona->id,$cod);

            $url=URL::temporarySignedRoute('codigos',now()->addMinutes(1));

            Mail::to($request->email)->send(new CodCorreo($persona,$cod,$url));

            return redirect('/login')->with('Mensaje','Estamos enviando un código a su correo');
        }
        else
        {return redirect('/login')->with('Mensaje','Email o contraseña invalido');}
    }
    public function registracion(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $persona = new User();
        $persona->name = $request->input('name');
        $persona->email = $request->input('email');
        $contra = bcrypt($request ->input('password'));
        $persona->password = $contra;
        $persona->save();

        if($persona->save()){
            return redirect('/login')->with('Mensaje','Hola,Bienvenid@');
        }
        else{
            return redirect('/register')->wit('Mensaje','Datos no validos');
        }
    }

    public function cerrarSesion()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }
}
