<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Deposito;
use App\Models\Gateway;
use App\Models\App;

class DepositoController extends Controller
{
    protected $depositoMinimo;

    public function __construct()
    {
        $depositoMin = App::select('deposito_minimo')->first();
        $this->depositoMinimo = $depositoMin ? floatval($depositoMin->deposito_minimo) : 2;
        $app = session()->get('user');
        $this->email = $app->email;
    }

    public function index()
    {
        // Obtenha as credenciais do gateway
        

        // Obtenha a URL e a Callback URL
        $callbackUrl = route('webhook.pix');


        

        return view('deposito.index', ['depositoMinimo' => $this->depositoMinimo, 'callbackUrl' => $callbackUrl]);
    }

    public function deposito(Request $request)
    {
        $form = $this->get_form($request);
        $pixRequests = Deposito::where('email', $this->email)->where('valor', $form['value'])->where('status', 'WAITING_FOR_APPROVAL')->get();
        $pixRequestsRecent = $pixRequests->filter(function ($pixRequest) {
            $createdTimeStamp = $pixRequest->created_at->getTimestamp();
            $currentTimeStamp = time();

            $difference = $currentTimeStamp - $createdTimeStamp;

            return $difference < 600;
        });

        $pixRequestsAntigos = $pixRequests->filter(function ($pixRequest) {
            $createdTimeStamp = $pixRequest->created_at->getTimestamp();
            $currentTimeStamp = time();
    
            $difference = $currentTimeStamp - $createdTimeStamp;
    
            return $difference > 600;
    
            })->each->delete();

        if($pixRequestsRecent->first()){
            $pixRequestsRecent = $pixRequestsRecent->first();
            $cookie = cookie('token', $pixRequestsRecent->external_reference, 10);
            
            return response()->json(['pix_key' => $pixRequestsRecent->payment_link_qrcode,'transactionId' => $pixRequestsRecent->external_reference], 200);
            //return redirect()->route('deposito.pix', ['pix_key' => $pixRequestsRecent->payment_link_qrcode])->withCookie($cookie);
        }
       
        $email = $this->email;
        // Valide o formulário
        $errors = $this->validate_form($form);
        
        // Se houver erros, redirecione de volta à página de depósito com os erros
        
        // $gatewayCredentials = $this->get_gateway_credentials();
        // $gatewayCredentialsArray = is_object($gatewayCredentials) ? get_object_vars($gatewayCredentials) : [];
        // $client_id = $gatewayCredentialsArray['client_id'];
        // $client_secret = $gatewayCredentialsArray['client_secret'];
        $gateway = Gateway::first();

        if($gateway){
            if($gateway->name == 'ezze'){
                $client_id = $gateway->client_id;
                $client_secret = $gateway->client_secret;
                return $this->EzzePix($form, $client_id, $client_secret);
            }

            if($gateway->name == 'suit'){
                $client_id = $gateway->client_id;
                $client_secret = $gateway->client_secret;
                return $this->SuitPay($form, $client_id, $client_secret);
            }

            if($gateway->name == 'prime'){
                $client_id = $gateway->client_id;
                $client_secret = $gateway->client_secret;
                return $this->PrimePix($form, $client_id, $client_secret);
            }
        }
        /*
        if(env('GATEWAY') == 'ezze'){
            $client_id = env('EZZE_CI');
            $client_secret = env('EZZE_CS');
            return $this->EzzePix($form, $client_id, $client_secret);
        }
        // Faça a solicitação PIX
        // Verifique a resposta da solicitação PIX
        */
        $client_id = env('SUIT_CI');
        $client_secret = env('SUIT_CS');
        return $this->SuitPay($form, $client_id, $client_secret);
        
        
    }

    // Métodos auxiliares...

    public function EzzePix($form, $client_id, $client_secret){
        $res = $this->makePix($form['name'], $form['cpf'], $form['value'], $client_id, $client_secret);
        if (isset($res['emvqrcps'])) {
            // Adicione a coluna 'data' e obtenha a data atual no formato dd/mm/aaaa hh:mm:ss, no horário de Brasília
            $userDate = $this->get_user_date();

            // Insira os dados na tabela confirmar_deposito
            //$this->insert_confirmar_deposito($this->email, $form['value'], $res['transactionId'], 'WAITING_FOR_APPROVAL', $userDate);

            $cookie = cookie('token', $res['transactionId'], 10);


            $userDate = date('Y-m-d H:i:s', strtotime($userDate . '+10 minutes'));
            
            $confirmação = Deposito::create([
                'email' => $email,
                'valor' => $form['value'],
                'external_reference' => $res['transactionId'],
                'payment_link_qrcode' => $res['emvqrcps'],
                'payment_link_expiration' => $userDate,
                'status' => 'WAITING_FOR_APPROVAL',
            ]);

            

            return response()->json(['pix_key' => $res['emvqrcps'], 'transactionId' => $res['transactionId']], 200);
        } else {
            // Se a resposta não for 'OK', redirecione de volta à página de depósito
            return redirect()->route('deposito.index');
        }
    }

    public function PrimePix($form, $client_id, $client_secret){
        $res = $this->makePixPrime($form['name'], $form['cpf'], $form['value'], $client_id, $client_secret);
        if (isset($res['qrcode'])) {
            // Adicione a coluna 'data' e obtenha a data atual no formato dd/mm/aaaa hh:mm:ss, no horário de Brasília
            $userDate = $this->get_user_date();

            // Insira os dados na tabela confirmar_deposito
            //$this->insert_confirmar_deposito($this->email, $form['value'], $res['transactionId'], 'WAITING_FOR_APPROVAL', $userDate);

            $cookie = cookie('token', $res['qrcode']['reference_code'], 10);


            $userDate = date('Y-m-d H:i:s', strtotime($userDate . '+10 minutes'));
            
            $confirmação = Deposito::create([
                'email' => $email,
                'valor' => $form['value'],
                'external_reference' => $res['qrcode']['reference_code'],
                'payment_link_qrcode' => $res['qrcode']['content'],
                'payment_link_expiration' => $userDate,
                'status' => 'WAITING_FOR_APPROVAL',
            ]);

            return response()->json(['pix_key' => $res['qrcode']['content'], 'transactionId' => $res['qrcode']['reference_code']], 200);

        } else {
            // Se a resposta não for 'OK', redirecione de volta à página de depósito
            return redirect()->route('deposito.index');
        }
    }

    public function SuitPay($form, $client_id, $client_secret){
        $res = $this->makePixSuit($form['name'], $form['cpf'], $form['value'], $client_id, $client_secret);
        
        if (isset($res['paymentCode'])) {
            
            // Adicione a coluna 'data' e obtenha a data atual no formato dd/mm/aaaa hh:mm:ss, no horário de Brasília
            $userDate = $this->get_user_date();

            // Insira os dados na tabela confirmar_deposito
            //$this->insert_confirmar_deposito($this->email, $form['value'], $res['idTransaction'], 'WAITING_FOR_APPROVAL', $userDate);

            $cookie = cookie('token', $res['idTransaction'], 10);


            $userDate = date('Y-m-d H:i:s', strtotime($userDate . '+10 minutes'));
            $confirmação = Deposito::create([
                'email' => $this->email,
                'valor' => $form['value'],
                'external_reference' => $res['idTransaction'],
                'payment_link_qrcode' => $res['paymentCode'],
                'payment_link_expiration' => $userDate,
                'status' => 'WAITING_FOR_APPROVAL',
            ]);
            
            return response()->json(['pix_key' => $res['paymentCode'], 'transactionId' => $res['idTransaction']], 200);
            //return redirect()->route('deposito.pix', ['pix_key' => $res['paymentCode']])->withCookie($cookie);
        } else {
            
            // Se a resposta não for 'OK', redirecione de volta à página de depósito
            return redirect()->route('deposito.index');
        }
    }

    protected function get_gateway_credentials()
    {
        if(env('DEV')){
            return (object) [
                'client_id' => env('DEV_CI'),
                'client_secret' => env('DEV_CS'),
            ];
        }
        return Gateway::select('client_id', 'client_secret')->first();
    }

    protected function check_jogoteste($email, $jogoteste)
    {
        // Verifique se a jogoteste não é 1
        return DB::table('appconfig')->where('email', $email)
            ->where(function ($query) {
                $query->whereNull('jogoteste')->orWhere('jogoteste', '!=', 1);
            })->exists();
    }

    protected function update_jogoteste($email)
    {
        // Atualize a coluna jogoteste para 1
        DB::table('appconfig')->where('email', $email)->update(['jogoteste' => 1]);
    }

    protected function get_user_date()
    {
        // Adiciona a coluna 'data' e obtém a data atual no formato dd/mm/aaaa hh:mm:ss, no horário de Brasília
        $brtTimeZone = new DateTimeZone('America/Sao_Paulo');
        $dateTime = new DateTime('now', $brtTimeZone);
        return $dateTime->format('Y-m-d H:i:s');
    }

    protected function insert_confirmar_deposito($email, $value, $idTransaction, $status, $userDate)
    {
        
        Deposito::create([
            'email' => $email,
            'valor' => $value,
            'external_reference' => $idTransaction,
            'status' => $status,
            
        ]);
    }

    public function makePix($name, $cpf, $value, $clientId, $clientSecret)
    {

        $callbackUrl = route('webhook.pix');
        
        $payload = [
            'amount' => floatval($value),
            'payer' => [
                'name' => $name,
                'document' => str_replace([".", "-"],"", $cpf),
            ]
        ];

        $authorization = $this->GetAuthorizationEzze();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $authorization,
        ])->post('https://api.ezzebank.com/v2/pix/qrcode', $payload);


        $res = $response->json();
        
        return $res;
    }

    public function makePixPrime()
    {

        $callbackUrl = route('webhook.pix');
        /*
        $payload = [
            'value_cents' => floatval($value) * 100,
            'generator_name' => $name,
            'generator_document' => str_replace([".", "-"],"", $cpf),
            "expiration_time" => "1800",
        ];
        */
        $payload2 = [
            'value_cents' => 10 * 100,
            'generator_name' => "Jonathan Santos",
            'generator_document' => "07916827573",
            "expiration_time" => "1800",
        ];

        $authorization = $this->GetAuthorizationPrime();
        $productionLink = "https://api.primepag.com.br";
        $sandboxLink = "https://api-stg.primepag.com.br";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $authorization,
        ])->post($productionLink . '/v1/pix/qrcodes', $payload2);


        $res = $response->json();
        dd($response);
        return $res;
    }

    protected function get_form(Request $request)
    {
        return [
            'name' => $request->nome,
            'cpf' => $request->cpf,
            'value' => $request->valor,
            // Adicione outros campos do formulário conforme necessário
        ];
    }

    protected function validate_form($form)
    {
        $errors = [];

        // Exemplo de validação para o campo 'name'
        if (empty($form['name'])) {
            $errors['name'] = 'O campo Nome é obrigatório.';
        }

        // Exemplo de validação para o campo 'cpf'
        if (empty($form['cpf'])) {
            $errors['cpf'] = 'O campo CPF é obrigatório.';
        }

        // Adicione outras validações conforme necessário

        return $errors;
    }
    
    public function consultaPagamento(Request $request){
        
        
        function bad_request()
        {
            return response()->json(400);   
        }
        
        if (!session()->has('token')) {
            bad_request();
        }
   
        $externalReference = $request->query('transactionId');
    
        $result = Deposito::select('status')->where('external_reference', $externalReference)->first();
        
        if (!$result) {
            
            return response()->json(['message' => 'Token inválido'], 400);
        }

        if($result->status == 'PAID_OUT'){
            return response()->json(['message' => 'Pagamento aprovado'], 200);
        }
        
        return response()->json(['message' => 'Pagamento pendente'], 200);

    }


    public function GetAuthorizationEzze(){
        

        if(Schema::hasTable('ezze_credentials') == false){
            Schema::create('ezze_credentials', function (Blueprint $table) {
                $table->id();
                $table->string('authorization_token');
                $table->timestamps();
            });
        }

        $lastAuthorization = DB::table('ezze_credentials')->latest('created_at')->first();
        
        if($lastAuthorization){
            
            if($lastAuthorization->created_at == null){
                DB::table('ezze_credentials')->where('id', $lastAuthorization->id)->delete();
            } else {
            
            $lastAuthorizationDate = new DateTime($lastAuthorization->created_at);
            $now = new DateTime();
            $diff = $now->diff($lastAuthorizationDate);
            if($diff->i < 25 || $diff->h == 0 || $diff->d == 0 || $diff->m == 0 || $diff->y == 0){
                return $lastAuthorization->authorization_token;
            }
        }
        }
        
        $cs = Gateway::select('client_secret')->where('name', 'ezze')->first();
        $ci = Gateway::select('client_id')->where('name', 'ezze')->first();
        $authorizationbase64 = base64_encode($ci->client_id . ':' . $cs->client_secret);
        
        $productionLink = "https://api.ezzebank.com/v2/oauth/token";
        $sandboxLink = "https://api-sandbox.ezzebank.com/v2/oauth/token";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $authorizationbase64,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post($productionLink, [
            'grant_type' => 'client_credentials',
        ]);

        dd($response);
        $res = $response->json();
        
        

        DB::table('ezze_credentials')->insert([
            'authorization_token' => $res['access_token'],
            'created_at' => now(),
        ]);

        return $res['access_token'];
    }

    public function GetAuthorizationPrime(){
        

        if(Schema::hasTable('prime_credentials') == false){
            Schema::create('prime_credentials', function (Blueprint $table) {
                $table->id();
                $table->string('authorization_token');
                $table->timestamps();
            });
        }

        $lastAuthorization = DB::table('prime_credentials')->latest('created_at')->first();
        
        if($lastAuthorization){
            
            if($lastAuthorization->created_at == null){
                DB::table('prime_credentials')->where('id', $lastAuthorization->id)->delete();
            } else {
            
            $lastAuthorizationDate = new DateTime($lastAuthorization->created_at);
            $now = new DateTime();
            $diff = $now->diff($lastAuthorizationDate);
            if($diff->i < 25 || $diff->h == 0 || $diff->d == 0 || $diff->m == 0 || $diff->y == 0){
                return $lastAuthorization->authorization_token;
            }
        }
        }
        
        $cs = Gateway::select('client_secret')->where('name', 'prime')->first();
        $ci = Gateway::select('client_id')->where('name', 'prime')->first();
        $authorizationbase64 = base64_encode($ci->client_id . ':' . $cs->client_secret);
        
        $productionLink = "https://api.primepag.com.br";
        $sandboxLink = "https://api-stg.primepag.com.br";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $authorizationbase64,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post($productionLink . "/auth/generate_token", [
            'grant_type' => 'client_credentials',
        ]);
        $res = $response->json();
        DB::table('prime_credentials')->insert([
            'authorization_token' => $res['access_token'],
            'created_at' => now(),
        ]);

        return $res['access_token'];
    }

    public function makePixSuit($name, $cpf, $value, $clientId, $clientSecret)
    {

        $callbackUrl = route('webhook.pix');

        $payload = [
            'requestNumber' => '12356',
            'dueDate' => $this->get_user_date(),
            'amount' => floatval($value),
            'client' => [
                'name' => $name,
                'email' => 'cliente@email.com',
                'document' => $cpf,
            ],
            'callbackUrl' => $callbackUrl,
        ];
        
        $linkSuit = env('DEV') ? "https://sandbox.ws.suitpay.app/api/v1/gateway/request-qrcode" : "https://ws.suitpay.app/api/v1/gateway/request-qrcode";
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'ci' => env("DEV") ? env("DEV_CI") : $clientId,
            'cs' => env("DEV") ? env("DEV_CS") : $clientSecret,
        ])->post($linkSuit, $payload);
        

        $res = $response->json();
        
        return $res;
    }
    

}
