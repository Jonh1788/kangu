<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pixel;
use App\Models\Deposito;
use App\Models\App;
use App\Models\Appconfig;
use App\Models\Gateway;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AdmLogin;

class AdmController extends Controller
{
    public function index(Request $request){

        if(!session()->has('emailadm')){
            return redirect('adm/login');
        }

        $status = $request->has('status') ? $request->query('status') : null;

        $numeroDepositos = Deposito::whereNotNull('valor');

        if($status){
            $numeroDepositos->where('status', $status);
        }

        $valorTotalDepositos = Deposito::where('status', '=', 'PAID_OUT')
        ->sum('valor');

        $quantidadeNumeroDepositos = $numeroDepositos->count();
        
        $result = App::get()->toArray();
        if($result == null){
            $result = [
                'depositos' => 0,
                'saques' => 0,
                'usuarios' => 0,
                'faturamento' => 0,
                'deposito_minimo' => 1,
                'saque_minimo' => 1,
                'dificuldade_jogo' => 1,
            ];

            
        }
        $quantidadeUsuarios = Appconfig::count();

        $totalSaques = 0;

        $valorTotalSaques = 0;

        $multiplicador = 1;
        
        
       
        return view("adm.index", ["result"=> $result[0], "quantidadeUsuarios" => $quantidadeUsuarios, 'quantidadeNumeroDepositos' => $quantidadeNumeroDepositos, 'valorTotalDepositos' => $valorTotalDepositos, 'totalSaques' => $totalSaques, 'valorTotalSaques' => $valorTotalSaques, 'multiplicador' => $multiplicador]);
    }

    public function processo(Request $request){

        try{

        if(!session()->has('emailadm')) {
            return redirect('adm/login');
        }

        if (!$request->isMethod('post')) {
            return response()->json(['message' => 'Metódo não permitido'] , 405);
        }

        function required($form, $field)
        {
            if (!isset($form[$field]) || !$form[$field]) {
                return "$field é requerido";
            }

            return null;
        }

        function validate_form($form, $fields)
        {
            foreach ($fields as $field) {
                if ($error = required($form, $field)) {
                    return $error;
                }
            }

            return null;
        }

        function get_form($request)
        {
            return array(
                'valor' => $request->input('valor'),
            );
        }
        
        $form = get_form($request);
        $error = validate_form($form, ['valor']);
        $valor = $form['valor'];

        if ($request->has('opcao')) {
            $opcao = $request->query('opcao');
        }

        $result = App::get();

        if ($error) {
            $msg = $error;
            var_dump($msg);
            var_dump($form);

        }else{
            
            switch($opcao){
                case "depositoMin":

                        if ($result->count() > 0) {
                            $result_update = App::update(['deposito_min' => $valor]);
                            
                            if ($result_update > 0) {
                                return redirect('../adm');
                                
                            } else {
                                return redirect('../adm');
                            }
                        } else {

                            $result_insert = App::insert(['deposito_min' => $valor]);

                            
                            if ($result_insert) {
                                return redirect('../adm');
                            } else {
                                return redirect('../adm');
                            }
                        }

                case "saqueMin":

                    if ($result->count() > 0) {
                        $result_update = App::update(['saques_min' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['saques_min' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                    }

                case "apostaMax":
                    if ($result->count() > 0) {
                        $result_update = App::update(['aposta_max' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['aposta_max' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                        }
                        
                       
                case "apostaMin":
                    if ($result->count() > 0) {
                        $result_update = App::update(['aposta_min' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['aposta_min' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                        }
                        
                case "rolloverSaque":
                    if ($result->count() > 0) {
                        $result_update = App::update(['rollover_saque' => $valor]);
                            
                            if ($result_update > 0) {
                                return redirect('../adm');
                                
                            } else {
                                return redirect('../adm');
                            }
                        } else {

                            $result_insert = App::insert(['rollover_saque' => $valor]);

                            
                            if ($result_insert) {
                                return redirect('../adm');
                            } else {
                                return redirect('../adm');
                            }
                        }
                        
                case "taxaSaque":
                    if ($result->count() > 0) {
                        $result_update = App::update(['taxa_saque' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['taxa_saque' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                        }

                case "dificuldadeJogo":
                    
                    if ($result->count() > 0) {
                        $result_update = App::update(['dificuldade_jogo' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['dificuldade_jogo' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                        }

                case "multiplicador":
            
                    if ($result->count() > 0) {
                        $result_update = App::update(['multiplicador' => $valor]);
                        
                        if ($result_update > 0) {
                            return redirect('../adm');
                            
                        } else {
                            return redirect('../adm');
                        }
                    } else {

                        $result_insert = App::insert(['multiplicador' => $valor]);

                        
                        if ($result_insert) {
                            return redirect('../adm');
                        } else {
                            return redirect('../adm');
                        }
                        }
                case "gateway": 
                    $clientId = $request->input('client_id');
                    $clientSecret = $request->input('client_secret');
                    $gateway = $request->input('gatewayName');
                    $result = Gateway::updateOrCreate(['client_id' => $clientId, 'client_secret' => $clientSecret, 'name' => $gateway]);
                    if($result){
                        return redirect('../adm/gateway');
                    } else {
                        return redirect('../adm/gateway');
                    }
                default:
                    echo "entrei default";
                    break;
            }

        }
        }catch(\Exception $ex){
                var_dump($ex);
                exit;
            }
        }
    public function login(Request $request){

        
        //$vida_sessao = 15 * 60;
        //session_set_cookie_params($vida_sessao);

        try{
            if($request->isMethod('post')){

                $email = $request->input('email');
                $senha = $request->input('senha');

                if(!Schema::hasTable('admlogin')){
                    Schema::create('admlogin', function(Blueprint $table){
                        $table->id();
                        $table->string('email');
                        $table->string('senha');
                        $table->timestamps();
                    });
                }
                

                $count = AdmLogin::count();

                if($count == 0){
                    AdmLogin::insert([
                        'email' => $email,
                        'senha' => $senha,
                    ]);
                }

                $result = AdmLogin::where('email', $email)
                ->where('senha', $senha)
                ->first();

                //verificando se o result esta vazio
             

                if($result){
                    session(['emailadm' => $email]);
                    return redirect('/adm');
                } else {
                    $erro = 'Email ou senha incorretos';
                    return view('adm.login', compact('erro'));
                }
            }    
        } catch (\Exception $e) {
            dd($e);
            exit;
        }

        return view('adm.login');


    }


    public function usuarios(Request $request){
        
        if(!session()->has('emailadm')){
            return redirect('/adm/login');
        }

        try {

            $leadAff = $request->has('leadAff') ? $request->query('leadAff') : null;

            $result = Appconfig::select("id");

            if (!empty($leadAff)) {
               
                $result->where('leadAff', $leadAff);
            }

            $result = $result->orderBy('created_at', 'desc')
            ->get();

            if (!$result) {
                die("Erro na consulta");
            }

            
            $sqlTotal = "SELECT COUNT(*) as total FROM appconfig";
            
            $resultTotal = Appconfig::count();

            if (!empty($leadAff)) {
                $resultTotal = Appconfig::where('lead_aff', $leadAff);
            }


            $total = ($resultTotal && $resultTotal > 0) ? $resultTotal : 0;

            $dataAgora = Carbon::now('America/Sao_paulo');

            $dataUmDiaAntes = $dataAgora->copy()->subDay();

            $resultUltimas24h = Appconfig::whereBetween('created_at', [$dataUmDiaAntes, $dataAgora]);
            // Adicionar cláusula WHERE se o parâmetro leadAff estiver presente
            if (!empty($leadAff)) {
                $resultUltimas24h->where('lead_aff', $leadAff);
            }

            $resultUltimas24h = $resultUltimas24h->get()->toArray();

            

            $ultimas24h = count($resultUltimas24h);
            
            return view('adm.usuarios', compact('ultimas24h', 'total'));

        } catch(\Exception $e) {
            var_dump($e);
            return response()->json(['message' => $e],200);
        }
    }

    public function bd(Request $request){

        if(!session()->has('emailadm')){
            return redirect('/adm/login');
        }

        try {
            
            
            
            $leadAff = $request->has('leadAff') ? $request->query('leadAff') : null;

            $result = Appconfig::get();
            
            if (!empty($leadAff)) {
                $result->where('afiliado', $leadAff);
            }

            $result  = Appconfig::orderBy('created_at', 'desc')->get();
            

            if ($result->isEmpty()) {
                die("Erro na consulta");
            }
            
            $data = $result->toArray();

            
     
            return response()->json($data, 200);
        } catch(\Exception $e) {
            dd($e);
            return response()->json(['error' => $e], 200);
        }

    }

    public function update(Request $request){

        if(!session()->has('emailadm')){
            return redirect('adm/login');
        }
        
        if (!$request->isMethod('post')) {
            return response()->json(['error'=> 'Metódo não permitido'], 405);
        }

        function get_form($request)
        {
            return array(
                'id' => $request->input('id'),
                'email' => $request->input('email'),
                'senha' => $request->input('senha'),
                'telefone' => $request->input('telefone'),
                'saldo' => $request->input('saldo'),
                'linkafiliado' => $request->input('linkafiliado'),
                'plano' => $request->input('plano'),
                'depositou' => $request->input('depositou'),
                'bloqueado' => $request->input('bloqueado'),
                'saldo_comissao' => $request->input('saldo_comissao'),
                'percas' => $request->input('percas'),
                'ganhos' => $request->input('ganhos'),
                'cpa' => $request->input('cpa'),
                'cpafake' => $request->input('cpafake'),
                'comissaofake' => $request->input('comissaofake'),
            );
        }

        $form = get_form($request);

        try{
            $result = Appconfig::where('id', $request->input('id'))
            ->update([
                'email' => $request->input('email'),
                'senha' => $request->input('senha'),
                'telefone' => $request->input('telefone'),
                'saldo' => $request->input('saldo'),
                'linkafiliado' => $request->input('linkafiliado'),
                'saldo_comissao' => $request->input('saldo_comissao'),           
            ]);

            if($result){
                return redirect('adm/usuarios');

            } else {
                return response('', 400);
            }
        } catch (\Exception $ex) {
            return response($ex, 500);
        }

    }

    public function depositos(Request $request){

        if(!session()->has('emailadm')){
            return redirect('adm/login');
        }

        $depositosRealizados = Deposito::whereNotNull('valor')
        ->get()->toArray();

        return view('adm.depositos', compact('depositosRealizados'));
    }

    public function utm(Request $request){

        $campanhas = Appconfig::whereNotNull('utm_campaign')
        ->where('utm_campaign','!=', '')
        ->groupBy('utm_campaign')
        ->select('utm_campaign', DB::raw('SUM(depositou) as total_deposito'), DB::raw('COUNT(*) as total_cadastros'))
        ->get();

        $campanhas2 = Appconfig::whereNotNull('utm_campaign')
        ->where('utm_campaign','!=', '')
        ->where('depositou','>',0)
        ->select('email', 'utm_campaign')
        ->get()
        ->groupBy('utm_campaign');

        $resultArray = [];
        
        foreach($campanhas2 as $campanha => $group){
            $utmArray = [];
            
            foreach($group as $result){
                
                $deposits = Deposito::where('email', $result->email)
                ->get();
                
                $depositsArray = [];

                foreach($deposits as $deposit){
                    $depositsArray[] = [
                        'valor' => $deposit->valor,
                        'data' => $deposit->data,
                    ];
                }
                
                if(!empty($depositsArray)){

                    $utmArray[] = [
                        'deposits' => $depositsArray
                    ];
                }
            }

            if(!empty($utmArray)){
                $resultArray[$campanha] = $utmArray;
            }
        }

       
   
        
        
        
        return view('adm.utm', compact('campanhas','resultArray'));
    }

    public function gateway(Request $request){
            
            if(!session()->has('emailadm')){
                return redirect('adm/login');
            }
    
            $gateways = Gateway::first();

            if($gateways){
                $clientId = $gateways->client_id;
                $clientSecret = $gateways->client_secret;
                $clientName = $gateways->name;
                return view('adm.gateway', compact('clientId', 'clientSecret', 'clientName'));
            }

            $clientId =  '';
            $clientSecret = '';
            $name = '';
            return view('adm.gateway', compact('clientId', 'clientSecret', 'name'));

            
    }

                
    public function gatewayUpdate(Request $request){
    if(!session()->has('emailadm')){
        return redirect('adm/login');
    }

    if (!$request->isMethod('post')) {
        return response()->json(['error'=> 'Método não permitido'], 405);
    }

    try{
        $gateways = Gateway::first();

        if($gateways){
            Gateway::update([
                'client_id' => $request->input('client_id'),
                'client_secret' => $request->input('client_secret'),
                'name' => $request->input('gatewayNome')
            ]);
        } else {
            Gateway::insert([
                'client_id' => $request->input('client_id'),
                'client_secret' => $request->input('client_secret'),
                'name' => $request->input('gatewayNome')
            ]);
        }

        return redirect('../adm/gateway');
    } catch (\Exception $ex) {
        return response($ex, 500);
    }
}

    public function pixels(Request $request){


        if(!\Schema::hasTable('pixels')){
            \Schema::create('pixels', function($table){
                $table->id();
                $table->string('name');
                $table->longText('code')->charset('binary');
                $table->string('url_slug')->unique();
                $table->timestamps();
            });
        }

        if($request->isMethod('post')){
            $name = $request->input('name');
            $code = $request->input('code');
            $url_slug = $request->input('url_slug');

            $result = DB::table('pixels')
            ->insert([
                'name' => $name,
                'code' => $code,
                'url_slug' => $url_slug
            ]);

            if($result){
                return redirect('adm/pixels');
            } else {
                return response('', 400);
            }
        }

        $pixels = Pixel::all();

        return view('adm.pixels', compact('pixels'));
    }

    public function deletePixel($id){
        if(!session()->has('emailadm')){
            return redirect('adm/login');
        }
        $result = DB::table('pixels')
        ->where('id', $id)
        ->delete();
        if($result){
            return response('', 200);
        } else {
            return response('', 400);
        }
        

    }



}
