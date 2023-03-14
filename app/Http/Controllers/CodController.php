<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;


class CodController extends Controller
{
    //
    public function codigos(Request $request)
    {
        if(!$request->hasValidSignature())
        {
            $AuthController = app(AuthController::class);
            self::eliminarCods(Auth::user()->id);
            $AuthController->cerrarSesion();
            abort(419);
        }
        else
        {
            return view('conf_cod');
        }
    }

    public function saveCodEmail($id,$codigo)
    {
        $persona = User::find($id);
        $persona->cod_correo = self::encriptar($codigo);
        $persona->save();
    }

    public function saveCodTel($id,$codigo)
    {
        $persona = User::find($id);
        $persona->cod_tel = self::encriptar($codigo);
        $persona->save();
    }
    public function eliminarCods($id)
    {
        $persona = User::find($id);
        $persona->cod_correo = null;
        $persona->cod_tel = null;
        $persona->save();
    }
    public function codApi(Request $request)
    {
        $search_users = DB::table('users')->get();
        if(!$search_users)
        {
            return response()->json([
                "Status"=>404,
                "Mensaje"=>"El codigo es incorrecto",
            ],404);
        }
        else
        {
            foreach($search_users as $su)
            {
                if(self::desencriptar($su->cod_correo) == $request->codigo)
                {
                    $codigo = rand(1000,9999);
                    self::saveCodTel($su->id,$codigo);
                    return response()->json([
                        "Status"=>200,
                        "Mensaje"=>"Nuevo codigo",
                        "Código"=>$codigo
                    ],200);
                }
            }

        }
    }
    public function valCod(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
        ]);
        $persona = User::find(Auth::user()->id);
        if(!$persona)
        {
            return redirect('/conf_cod')->with('Mensaje','Los códigos no coinciden');
        }
        else
        {
            $persona->cod_tel = self::desencriptar($persona->cod_tel);
            $persona->save();

            $validarCod = User::where("cod_tel", "=", $request->codigo)->first();
            if(!$validarCod)
            {
                return redirect('/conf_cod')->with('Mensaje','Los códigos no coinciden');
            }
            else
            {
                $persona->cod_correo = self::encriptar($persona->cod_correo);
                $persona->cod_tel = self::encriptar($persona->cod_tel);
                $persona->status = true;
                $persona->save();
                if($persona->save())
                {
                    self::eliminarCods(Auth::user()->id);
                    return redirect('/home')->with('Mensaje','Bienvenid@');
                }
            }
        }


    }
    public function encriptar($codigo)
    {
        $codEncryp = Crypt::encryptString($codigo);
        return $codEncryp;
    }
    public function desencriptar($codigo)
    {
        $codDesencryp = Crypt::decryptString($codigo);
        return $codDesencryp;
    }

}
