@extends('adminlte::page')

@section('htmlheader_title')
	Edição
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Atualizar Prestador de Serviço</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('provider.index') }}"><i class="glyphicon glyphicon-backward"></i> Retornar</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Tem algum problema com tuas entradas.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

	{{ Form::open(array('route' => ['provider.update',$provider->id] , 'files' => true)) }}
    <!--form action="{{ route('provider.update',$provider->id) }}" method="POST" class="form" -->

        @csrf

		@method('PUT')
		
		<input type="hidden" id="hdn_list" name="hdn_list"/>


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="name" value="{{ $provider->name }}" class="form-control" placeholder="Nome" required >
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $provider->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefone Fixo:</strong>
                    <input type="text" name="home_phone" value="{{ $provider->home_phone }}" class="form-control" placeholder="Telefone Fixo">
                </div>
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefone Celular:</strong>
                    <input type="text" name="mobile_phone" value="{{ $provider->mobile_phone }}" class="form-control" placeholder="Telefone Celular">
                </div>
            </div>
		</div>
		<div class="row">
            			<div class="col-xs-12 col-sm-12 col-md-4">
                			<div class="form-group">
                		    	<strong>RG:</strong>
                		    	<input type="text" name="rg" value="{{ $provider->rg }}" class="form-control" placeholder="RG">
                			</div>
	            		</div>

            			<div class="col-xs-12 col-sm-12 col-md-4">
                			<div class="form-group">
                		    	<strong>CPF:</strong>
                		    	<input type="text" name="cpf" value="{{ $provider->cpf }}" class="form-control" placeholder="CPF">
                			</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-4">
                			<div class="form-group">
                		    	<strong>Genero:</strong>
                		    	<input type="number" name="gender" value="{{ $provider->gender }}" class="form-control" placeholder="Genero">
                			</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-3">
                			<div class="form-group">
                		    	<strong>Banco:</strong>
                		    	<input type="text" name="bank" value="{{ $provider->bank }}" class="form-control" placeholder="Banco">
                			</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
                			<div class="form-group">
                		    	<strong>Agencia:</strong>
                		    	<input type="text" name="ag" value="{{ $provider->ag }}" class="form-control" placeholder="Agencia">
                			</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
                			<div class="form-group">
                		    	<strong>Conta:</strong>
                		    	<input type="text" name="account" value="{{ $provider->account }}" class="form-control" placeholder="Conta">
                			</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
                			<div class="form-group">
                		    	<strong>Variação:</strong>
                		    	<input type="text" name="variation" value="{{ $provider->variation }}" class="form-control" placeholder="Variação">
                			</div>
						</div>


	    	<div class="col-xs-12 col-sm-12 col-md-9">
                <div class="form-group">
                    <strong>URL da Imagem:</strong>
                    {{ Form::text('url_image', $provider->url_image ,['class' => 'form-control','placeholder' => 'URL' ]) }}

                </div>
            </div>
			
			<div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <strong>Imagem:</strong>

                    {{ Form::file('image',['class'=>'']) }}

                </div>
            </div>

    {{ Form::close() }}
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="box box-solid">
					<br>


					<div class="col-xs-12 col-sm-12 col-md-5">
						<div class="form-group">
							<strong>Categoria:</strong>
								{{ Form::select('type_id' , $categories , $provider->type_id , ['id'=>'type', 'class'=>'form-control']) }}
						</div>
					</div>
					
					</td><td>
						
					<div class="col-xs-12 col-sm-12 col-md-6">
						<div class="form-group">
							<strong>Sub Categoria:</strong>
								{{ Form::select('subtype_id' , $subcategories , $provider->subtype_id , ['id'=>'subtype', 'class'=>'form-control'] ) }}
						</div>
					</div>

					</td><td>
					<div class="col-xs-6 col-sm-12 col-md-1">
						<br>
						<a class="btn btn-success btn-big btn-add" id="add_test_button"><i class="glyphicon glyphicon-plus"></i></a>
					</div>
					


				<table class="table table-striped" style="text-align: center;" >
					<thead>
						<tr>
							<th style="text-align: center;"> Atividades </th>
							<th colspan="1">Operação</th>
						</tr>
					</thead>
					<tbody id="list" >
					</tbody>
				</table>
			</div>
			</div>
			</div>
			
			
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Salvar</button>
            </div>

		</div>
		<br>





	<script type="text/javascript" language="javascript" >
	
		
		window.setTimeout ( () => {
		    $('#type').change(function(){
		        $.get("{{ url('/api/dropdown') }}/"+$(this).val(), 
		        { }, 
		        function(data) {
		            $('#subtype').empty(); 
		            $.each(data, function(key, element) {
		                $('#subtype').append("<option value='" + key +"'>" + element + "</option>");
		            });
		        });
		    });


						@foreach($subtypes as $item)
							add_manual_item( $('#subtype'), $('#list'), {{ $item['id'] }}, "{{ $item['description'] }}" );
						@endforeach


			$("#add_test_button").on("click", function () {  add_item($('#subtype'), $('#list') ); $('#subtype').val(""); });

			$("body").on("submit", ".form", function(evt)
			{
				var all_the_items = true;
				$('[id^="list"]').each (function (a, b) { all_the_items &= collect_items (b.id); });
				if (!all_the_items && ($("form").attr ("required_items").length > 0))
				{
					alert ("Por favor, cadastre " + $("form").attr ("required_items"));
					return false;
				}
			});



		}, 500);




			var row_template = 
			    "<tr ref=\"[.id.]\">" +
			    "\t<td id=\"[.id.]\">[.test.]</td>" + 
			    "\t<td class=\"col-md-1\"><a class=\"btn btn-sm btn-danger btn_remove_row\"><i class=\"glyphicon glyphicon-trash\"></i> Apagar</a></td>" + 
			    "</tr>";

			function add_item (combo, list)
			{
				if (!$(combo).val()) return;
				var new_row =
					row_template
						.replace(/\[\.id\.\]/g, $(combo).val())
						.replace(/\[\.test\.\]/g, $('#' + $(combo)[0].id + ' option:selected').text())
						;
				$('#' + $(list)[0].id).append(new_row);
				$(".btn_remove_row").on('click', function () { remove_item (combo, $(this)); });
			}

			function add_manual_item (combo, list, item_id, item_description)
			{
				var new_row =
					row_template
						.replace(/\[\.id\.\]/g, item_id)
						.replace(/\[\.test\.\]/g, item_description)
						;
				$('#' + $(list)[0].id).append(new_row);
				$(".btn_remove_row").on('click', function () { remove_item (combo, $(this)); });
			}

			function remove_item (combo, item)
			{
				var ref = $(item).parent().parent().attr("ref");
				$(item).parent().parent().remove();
			}

			function collect_items ($container)
			{
				var items = "";
				var num_rows = document.getElementById($container).rows.length;
				for (var i=0; i < num_rows; i++)
				{
					var item = document.getElementById($container).rows [i].cells [0].id;

					if (item != "")
					{
						items += item;
						items += "|";
					}
				}
				$("#hdn_" + $container).val (items);
				return (items != "");
			}

	</script>

@endsection
