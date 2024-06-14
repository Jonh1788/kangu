<?php

namespace App\Http\Controllers;

use App\Models\PixRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Deposito;
use App\Models\Appconfig;
use App\Models\App;

class Webhook extends Controller
{
    public function index(Request $request){

        if($request->isMethod("post")){
            
            $dados = file_get_contents("php://input");
            $id_pagstar = '3.128.119.90';

            if($request->ip() !== $id_pagstar){
                http_response_code(403);
                echo '<p>Acesso não autorizado</p>';
                exit;
            }

            $dados_array = json_decode($dados, true);
            $dados_log = date('Y-m-d H:i:s') . "\n" . print_r($dados_array, true) . "\n\n";
            $logFile = 'webhook_log.txt';
            file_put_contents($logFile, $dados_log, FILE_APPEND);
            $value = $dados_array['value']; // Substitua 'value' pelo nome correto do campo
            $email = session()->has('email') ? session('email') : 'N/A';
            $code = $dados_array['external_reference']; // Substitua 'external_reference' pelo nome correto do campo
            $status = $dados_array['status']; // Substitua 'status' pelo nome correto do campo
            $data = date('Y-m-d H:i:s');

            $dadosInsercao = [
                'value' => $value,
                'email'=> $email,
                'status'=> $status,
                'data'=> $data,
                'code' => $code,
            ];

            $result = DB::table('pix_deposito')
            ->insert($dadosInsercao);

            if($result){
                echo '<h2>Dados inseridos na tabela com sucesso!</h2>';
            } else {
                echo '<h2>Erro ao inserir dados na tabela</h2>';
            }

            echo '<h2>Webhook Recebido com Sucesso!</h2>';
            echo '<h3>Dados Recebidos:</h3>';
            echo '<pre>' . print_r($dados_array, true) . '</pre>';

        } else {
            http_response_code(405);
            echo '<h2>Método não permitido</h2>';
            echo '<p>Certifique-se de que o método da sua solicitação é POST.</p>';
        }

            $logFile = 'webhook_log.txt';


            if (file_exists($logFile)) {

                $logs = file_get_contents($logFile);
                echo '<h3>Logs:</h3>';
                echo '<pre>' . htmlspecialchars($logs) . '</pre>';
            } else {
                echo '<p>Nenhum log disponível</p>';
            }



            echo 'Valor da Sessão (no final do script): ' . session('email');

    }

    public function pix(Request $request){

        
        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);

        function bad_request()
        {
            return response()->json(['message' => 'Requisição inválida.'], 400);
            
        }


        if (!$request->isMethod('post')) {
           return bad_request();
        }

       

        $payload = $request->getContent();

       
        
        $payload = json_decode($payload, true);
        
        

        if (is_null($payload)) {
            
            return bad_request();
        }
        
        if(!isset($payload['requestBody']['transactionType']) && !isset($payload['idTransaction']) && !isset($payload['notification_type'])){
            
           return bad_request();
        }
        

        $externalReference = "";

        if(isset($payload['requestBody']['transactionType'])){
            if($payload['requestBody']['transactionType'] !== 'RECEIVEPIX'){
                return bad_request();
            }

            $externalReference = $payload['requestBody']['transactionId'];
            
        } else if (isset($payload['idTransaction'])) {

            $externalReference = $payload['idTransaction'];

        } else if (isset($payload['notification_type'])) {
            $externalReference = $payload['message']['reference_code'];
        }
         else {
           return bad_request();
        }
        $status = 'PAID_OUT';

# if the payment is confirmed
if ($status === 'PAID_OUT') {
    $result = Deposito::where('external_reference', $externalReference)
    ->first();

    if (!$result) {
        bad_request();
    }

    if ($result->status === 'PAID_OUT') {
        bad_request();
    }

    Deposito::where('external_reference', $externalReference)
    ->update([
        'status' => 'PAID_OUT'
    ]);
	
	$valor_depositado = $result->valor;
	$email = $result->email;

    $resultUser = Appconfig::where('email', $email)
    ->first();

    $resultApp = App::first();

    $resultDeposito = Deposito::where('email', $email)
    ->count();

    Appconfig::where('email', $email)
    ->update([
        'depositos' => DB::raw('depositos + ' . intval($valor_depositado)),
    ]);
                                          
	if ($resultDeposito >= 1) {
	    
		if (!is_null($resultUser->afiliado) && !empty($resultUser->afiliado)) {
		    
			if (intval($result->valor) >= $resultApp->deposito_min_cpa) {
			    $randomNumber = rand(0, 100);
			    
                if($randomNumber <= intval($resultApp->chance_afiliado)){
                    
                    if($resultUser->status_primeiro_deposito === 0){
                       Appconfig::where('email', $resultUser->email)
                        ->update([
                            'status_primeiro_deposito' => 1,
                        ]);

                       Appconfig::where('id', $resultUser->afiliado)
                        ->update([
                            'saldo_comissao' => DB::raw('saldo_cpa + ' .   intval($valor_depositado)),
                        ]);

                    }else{

                        Appconfig::where('email', $resultUser->email)
                        ->update([
                            'status_primeiro_deposito' => 1,
                        ]);

                        Appconfig::where('id', $resultUser->afiliado)
                        ->update([
                            'saldo_comissao' => DB::raw('saldo_cpa + ' . intval($valor_depositado)),
                        ]);
                    }
                }
			}
		}
	}
	
	
    # update the user balance original
    //$result = $conn->query(sprintf("UPDATE appconfig SET saldo = saldo + %s WHERE email = '%s'", intval($result['valor']) + intval($value), $result['email']));
    function calcularMultiplicacao($valor) {
        if($valor < 20){
            return $valor;
        }
        if($valor === 20){
            return 20;
        }

        if($valor === 25){
            return 55;
        }

        if($valor === 30){
            return 80;
        }

        if($valor === 50){
            return 150;
        }

        if($valor > 50){
            return $valor;
        }
    }

    $novoSaldo = calcularMultiplicacao(intval($result->valor));

    Appconfig::where('email', $result->email)
    ->update([
        'saldo' => DB::raw('saldo + ' . $novoSaldo),
    ]);

   $responseData = ['success' => true, 'message' => 'Pagamento do PIX confirmado.'];

    return response()->json($responseData, 200);
        }

    }
}
