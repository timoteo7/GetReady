<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        
        <script type="text/javascript" src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                    
                    <br/>Session:<input id='session_id' name='session_id' size=50 value={{ PagSeguro::startSession() }}> <br/>
                    <input id='senderHash' name='senderHash' size=100 ><br/>
                    
                    @php
						
						$url = file_get_contents('https://sandbox.pagseguro.uol.com.br/checkout/direct-payment/i-ck.html');
						preg_match('#id="senderTrackingHash" value="(.*)" \/>#', $url, $hash);
						echo "<br/>SenderTrack:<input id='senderTrackingHash' name='senderTrackingHash' size=100 value='".$hash[1]."' >";
						
						
						preg_match('#<script type="text\/javascript" src="(.*\/pagseguro\.mediator\.directpayment\..*\.js)"><\/script>#', $url, $vetor);$url = file_get_contents($vetor[1]);
						preg_match('#this\.sessionId;this\.owner="(.*)";this\.origin#', $url, $vetor);
						echo "<br/>Owner:<input id='owner' name='owner' size=100 value='".$vetor[1]."' >";
						
						// chamar encrypted-cc para cartão de crédito
						
					@endphp
                    
                    
                    <button type="button" class="btn btn-success" id="buy-button" onclick="document.getElementById('senderHash').value=PagSeguroDirectPayment.getSenderHash();" >Confirmar dados do cartão</button>
                    
                    
                </div>
            </div>
        </div>
        
        		<div style="width: 100%; height: 700px; border: 1px solid gray; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					{!! Mapper::render() !!}
				</div>
        
           <script type="text/javascript" language="javascript">
			
			//PagSeguroDirectPayment.setSessionId(document.getElementById('session_id').value);
			
			/*
			var param = {
			cardNumber: 4111111111111111, //$("input#cartao").val(),
			cvv: 123, //$("input#cvv").val(),
			expirationMonth: 12, //$("input#validadeMes").val(),
			expirationYear: 2030, //$("input#validadeAno").val(),
			
			success: function(response) {
			
				console.log(response['card']['token']);
				alert(JSON.stringify(response['card']['token']));
				//token gerado, esse deve ser usado na chamada da API do Checkout Transparente
				
			},
			error: function(response) {
				alert('ERRO');
			//tratamento do erro
			},
			complete: function(response) {
			//tratamento comum para todas chamadas
			}
		}

		//parâmetro opcional para qualquer chamada
		//if($("input#bandeira").val() != '') {
			param.brand = 'visa';//$("input#bandeira").val();
		//}

		PagSeguroDirectPayment.createCardToken(param);*/
			
			
			/*
			$(document).ready(function() // precisa do jquery
			{
				
				alert(document.getElementById('session_id').value);	

			});*/


		</script>
        
    </body>
</html>
