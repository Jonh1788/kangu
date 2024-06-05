<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appconfig;

class GameController extends Controller
{

    public function index(Request $request){
        $user = session()->get('user');
        $cookie = cookie('token', bcrypt($user->id), 60);  
        $aposta = $request->query('aposta');
        $saldo = Appconfig::where('email', $user->email)->first()->saldo;
        if($aposta == null){
            $aposta = 1;
        }
        return response()->view('game.index', compact('aposta', 'saldo'))->withCookie('token', bcrypt($user->id));
    }
    public function update(Request $request){
        $user = session()->get('user');
        $email = $request->email;
        $token = $request->token;
        $valor = $request->saldo;
        if(\Hash::check($user->id, $token)){
            $app = Appconfig::where('email', $email)->first();
            $app->saldo = $valor;
            $app->save();
            return response()->json(['saldo' => $app->saldo]);
        }

        return response()->json(['error' => 'Token inválido', 'cookie' => $request->cookie('token')]);
    }

    public function wasm($file){
        $filePath = public_path('storage/Build2/' . $file);
        $fileGet = Storage::path($file);
        dd($fileGet);
        if(Str::endsWith($file, 'wasm.br')){
            return response()->file($fileGet, [
                'Content-Type' => 'application/wasm',
                'Content-Encoding' => 'br'
            ]);
        }

        if(Str::endsWith($file, 'br')){

            return response()->file($filePath, [
                'Content-Encoding' => 'br',
                'Content-Type' => 'application/javascript'
            ]);
        }
    }

    public function demo(){
        if(!session()->has('user')){
            return view('game.demo', ['user' => null]);
        }

        return view('game.demo', ['user' => session()->get('user'), 'saldo' => 100, 'aposta' => 5]);

        
    }
}
