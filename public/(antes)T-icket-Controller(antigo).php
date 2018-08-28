<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PagSeguro;

class TicketaaaControllerantigo extends Controller
{

    public function index()
    {
        //return response()->json(Provider::get(), 200);
    }


    public function store(Request $request)
    {
    	$array_request=$request->toArray();
    	
    	//dd($request);
    	
    	//$sessao = PagSeguro::startSession();
    	$url = file_get_contents('https://sandbox.pagseguro.uol.com.br/checkout/direct-payment/i-ck.html');
		preg_match('#id="senderTrackingHash" value="(.*)" \/>#', $url, $vetor);
		$hash=$vetor[1];
		$array_request['senderHash']=$hash;
		
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
					$array_request
				/*	[
					'senderName' => 'Jose Comprador', //Deve conter nome e sobrenome
					'senderPhone' => '(32) 1324-1421', //Código de área enviado junto com o telefone
					'senderEmail' => 'c49611470706901926299@sandbox.pagseguro.com.br',
					'senderHash' => $hash, //'fbd39360502dfb0a25cbfc87e5d1be6964eb5e200ef41c7da563e089f775c31a',
					'senderCPF' => '22111944785' //Ou CNPJ se for Pessoa Júridica
					]*/
					)
			/*->setShippingAddress([ // OPCIONAL
				'shippingAddressStreet' => 'Rua/Avenida',
				'shippingAddressNumber' => 'Número',
				'shippingAddressDistrict' => 'Bairro',
				'shippingAddressPostalCode' => '12345-678',
				'shippingAddressCity' => 'Cidade',
				'shippingAddressState' => 'SP'
			])*/
			/*
			->setBillingAddress([     // CARTÃO DE CRÉDITO
				'billingAddressStreet' => 'Rua/Avenida',
				'billingAddressNumber' => 'Número',
				'billingAddressDistrict' => 'Bairro',
				'billingAddressPostalCode' => '12345-678',
				'billingAddressCity' => 'Cidade',
				'billingAddressState' => 'SP'
			])
			*/
			/*
			->setCreditCardHolder([		// CARTÃO DE CRÉDITO
				'creditCardHolderBirthDate' => '10/02/2000', // OBRIGATÓRIO
				
				//'creditCardHolderName' => 'Nome Completo', //Deve conter nome e sobrenome
				//'creditCardHolderCPF' => '22111944785', //Ou CNPJ se for Pessoa Júridica
				//'creditCardHolderPhone' => '(32) 1324-1421', //Código de área enviado junto com o telefone
			])
			*/
		
			->setItems(
				[
				$array_request	
			/*
				[
					'itemId' => 'ID',
					'itemDescription' => 'Teste 2 em casa quinta',
					'itemAmount' => 20.01, //Valor unitário
					'itemQuantity' => '1', // Quantidade de itens
				]
			*/
				]
			)
			->send(
				//[
				$array_request
				//'paymentMethod' => 'boleto'
				
					//'paymentMethod' => 'eft',
					//'bankName' => 'itau'
				  
				  /*
					'paymentMethod' => 'creditCard',
					'creditCardToken' => '70fbd8dbece94c4bb05a9182af9607b2',
					'installmentQuantity' => '1',
					'installmentValue' => 20.01,
					*/
			//]
			);
		}
		catch(\Artistas\PagSeguro\PagSeguroException $e) {
			$e->getCode(); //codigo do erro
			dd($e->getMessage()); //mensagem do erro
		}

        return response()->json($pagseguro,201);
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
