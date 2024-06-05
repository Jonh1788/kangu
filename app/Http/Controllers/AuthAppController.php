<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appconfig;
use Illuminate\Support\Facades\Hash;

class AuthAppController extends Controller
{
    public function register(Request $request){

        
        if(Appconfig::where('email', $request->email)->first()){
            return redirect(route('cadastrar'))->withErrors(['email' => 'Email já cadastrado']);
        }
        $app = new Appconfig();
        $app->nome = $request->nome;
        $app->email = $request->email;
        $app->senha = bcrypt($request->senha);
        $app->telefone = $request->telefone;
        $app->saldo = 0;
        $app->afiliado = $request->afiliado ? $request->afiliado : 0;
        $app->save();

        $linkAfiliado = url('/cadastro') . "?id=" . $app->id;
        $app->linkAfiliado = $linkAfiliado;
        $app->save();
        session()->put('user', $app);
        return redirect('/dashboard');
    }

    public function login(Request $request){
        $app = Appconfig::where('email', $request->email)->first();
        
        if(!$app || !Hash::check($request->senha, $app->senha)){
            
            return redirect(route('login'))->withErrors(['email' => 'Email ou senha incorretos']);
        }
        session()->put('user', $app);
        return redirect('/dashboard');
    }
}
