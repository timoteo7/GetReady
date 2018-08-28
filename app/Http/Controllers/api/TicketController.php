<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PagSeguro;
use Auth;
use App\Order;
use App\Customer;
use App\Place;


class TicketController extends Controller
{

    public function index()
    {
        //return response()->json(Provider::get(), 200);
    }


    public function store(Request $request)
    {
		$input = $request->all();
    	
    	$user=Auth::user();
    	$order=Order::find(	$input['order_id']);
    	$place=Place::find( $user->customer->main_place_id );
  
    	$paymentMethod = (isset($request->cardNumber)) ? 'creditCard' : 'boleto';
    	
		if($paymentMethod == 'boleto')
		{

			$request->merge([ 'token' => '0493F2EDAF2655140597160EBAE7096CDCF27661B23CE6387724D724A09A31B2' ]);

			//QUEM
			$request->merge([ 'payerName' => $user->customer->name ]);
				//$request->merge([ 'payerName' => $request->input('senderName') ]);
				//if($request->has('senderCPF'))
				
			$request->merge([ 'payerCpfCnpj' => $user->customer->cpf ]);
				//$request->merge([ 'payerCpfCnpj' => $request->input('senderCPF') ]);
				
				//else
				//if($request->has('senderCNPJ'))
				//$request->merge([ 'payerCpfCnpj' => $request->input('senderCNPJ') ]);
			
			
			//O QUE
			$request->merge([ 'description' => $order->activity->subtype['description'] ]);
			$request->merge([ 'amount' => number_format( ($order->activity['amount']) ,2,'.',',') ]);
			
			

			/*
			$parametros= array(
			'token' => '0493F2EDAF2655140597160EBAE7096CDCF27661B23CE6387724D724A09A31B2',
			'description' => 'Pedido 1010',
			'amount' => '20',
			'payerName' => 'cliente',
			'payerCpfCnpj' => '04304255975');
			*/

			$ch = curl_init('https://sandbox.boletobancario.com/boletofacil/integration/api/v1/issue-charge');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request->all());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$ret=curl_exec($ch);
			if (!$ret)
			{
				die (curl_error($ch));
				
			}
			curl_close($ch);
			
			//header('Content-Type: application/json; charset=utf-8');
			//return response()->json($response);
			
			
			$order->update( ['transaction_code' => json_decode($ret)->data->charges[0]->billetDetails->ourNumber, 'status' => 'WAITING_CUSTOMER_PAYMENT_CONFIRMATION'] );
			//$order->update( ['transaction_code' => json_decode($ret)->data->charges[0]->billetDetails->barcodeNumber ] );
			
			return response($ret, 200)->header('Content-Type', 'application/json');
		}
		else 
		{

			$array_request=$request->all();

    		$url = file_get_contents('https://sandbox.pagseguro.uol.com.br/checkout/direct-payment/i-ck.html');
			preg_match('#id="senderTrackingHash" value="(.*)" \/>#', $url, $vetor);
			$array_request['hash']=$vetor[1];
			
			$array_request['session']=PagSeguro::startSession(); // pode tirar depois
			
			if(!isset($array_request['brand']))$array_request['brand']='';
			if(!isset($array_request['cvv']))$array_request['cvv']='';
			if(!isset($array_request['expirationMonth']))$array_request['expirationMonth']='';
			if(!isset($array_request['expirationYear']))$array_request['expirationYear']='';
		
			$array_request['creditCardToken']= exec('./bin/phantomjs ./js/creditCardToken.js '.PagSeguro::startSession().' '.$array_request['cardNumber'].' '.$array_request['brand'].' '.$array_request['cvv'].' '.$array_request['expirationMonth'].' '.$array_request['expirationYear']);

			
			/*
			$padrao_item=['itemId'];
		
			$novoarray=[];
			foreach ($request->toArray() as $key=>$value) {
				$novoarray[$key]=$value;
			}
			*/

        	try{
				$pagseguro = PagSeguro::setReference('0001')
					->setSenderInfo(
					//	$array_request
						[
						'senderName' => $user->customer->name, //Deve conter nome e sobrenome
						'senderPhone' => $user->customer->mobile_phone, //'(32) 1324-1421', //Código de área enviado junto com o telefone
						'senderEmail' => $user->customer->email,//'c49611470706901926299@sandbox.pagseguro.com.br',
						'senderHash' => $array_request['hash'], //'fbd39360502dfb0a25cbfc87e5d1be6964eb5e200ef41c7da563e089f775c31a',
						'senderCPF' => $user->customer->cpf , //Ou CNPJ se for Pessoa Júridica
						]
					)
					
					->setBillingAddress([     // CARTÃO DE CRÉDITO
						'billingAddressStreet' => $place->street,
						'billingAddressNumber' => $place->number,
						'billingAddressDistrict' => $place->district,
						'billingAddressPostalCode' => $place->postcode, // 12120-000
						'billingAddressCity' => $place->city,
						'billingAddressState' => $place->state,
						
						//'billingAddressCountry' => 'BRA'
						
					])
					
					->setCreditCardHolder([		// CARTÃO DE CRÉDITO
						'creditCardHolderBirthDate' => '10/02/2000', // OBRIGATÓRIO
				
						//'creditCardHolderName' => 'Nome Completo', //Deve conter nome e sobrenome
						//'creditCardHolderCPF' => '22111944785', //Ou CNPJ se for Pessoa Júridica
						//'creditCardHolderPhone' => '(32) 1324-1421', //Código de área enviado junto com o telefone
			
						//'creditCardHolderPhone' => '1324-1421',
					])
				->setItems(
					[
										
				[
					'itemId' => 'ID',
					'itemDescription' => $order->activity->subtype['description'],
					'itemAmount' => number_format( ($order->activity['amount']) ,2,'.',','), //Valor unitário
					'itemQuantity' => '1', // Quantidade de itens
				]

					]
				)
				->send(
					//$array_request
					///*
					[
					'paymentMethod' => 'creditCard',
					'creditCardToken' => $array_request['creditCardToken'], //'70fbd8dbece94c4bb05a9182af9607b2',
					'installmentQuantity' => '1',
					'installmentValue' => number_format( ($order->activity['amount']) ,2,'.',','),
					]//*/
				);
			}
			catch(\Artistas\PagSeguro\PagSeguroException $e) {
				$e->getCode(); //codigo do erro
				//dd($array_request);
				//dd($e->getMessage()); //mensagem do erro
				return response()->json($e->getMessage(),500);
			}
			
			$order->update( ['transaction_code' => $pagseguro->code ] );
			
        	return response()->json($pagseguro,201);
		}
		
    }


    public function show(Provider $provider)
    {
        //return response()->json($provider,200);
    }


    public function update(Request $request, Provider $provider)
    {
		//$provider->update($request->all());
        //return response()->json($provider,200);
    }


    public function destroy(Provider $provider)
    {
        //return response()->json($provider->delete(), 204);
    }
}
