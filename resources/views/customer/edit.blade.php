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
                <a class="btn btn-primary" href="{{ route('provider.index') }}"> Retornar</a>
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


    <form action="{{ route('provider.update',$provider->id) }}" method="POST">

        @csrf

        @method('PUT')


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="name" value="{{ $provider->name }}" class="form-control" placeholder="Nome">
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

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Endereço:</strong>
                    <input type="text" name="address" value="{{ $provider->address }}" class="form-control" placeholder="Endereço">
                </div>
            </div>
			<center>
			<table border=0>
				<tr>
					<td>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>CEP:</strong>
                    <input type="text" name="postcode" value="{{ $provider->postcode }}" class="form-control" placeholder="CEP">
                </div>
            </div>
					</td>

					<td>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>RG:</strong>
                    <input type="text" name="rg" value="{{ $provider->rg }}" class="form-control" placeholder="RG">
                </div>

            </div>
					</td>

					<td>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

					<td>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Latitude:</strong>
								<input type="text" name="latitude" value="{{ $provider->latitude }}" class="form-control" placeholder="Latitude">
							</div>
						</div>
					</td>
					<td>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<strong>Longitude:</strong>
								<input type="text" name="longitude" value="{{ $provider->longitude }}" class="form-control" placeholder="Longitude">
							</div>
						</div>
					</td>

					<td>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoria:</strong>
                           {{ Form::select('type_id' , $categories , $provider->type_id) }}
                </div>

            </div>
					</td>
				</tr>
			</table>
			
						<br/><br/>
			<hr><br/>
			
			<div class="row">
			<div class="col-md-9 col-md-offset-1">
			<div class="box box-solid">

				<table border=0>
				<tr>
					<td>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Categoria:</strong>
								{{ Form::select('type_id' , $categories , $provider->type_id) }}
						</div>
					</div>
					
					</td><td>
						
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Sub Categoria:</strong>
								{{ Form::select('subtype_id' , $subcategories , $provider->subtype_id) }}
						</div>
					</div>
					
					</td><td>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Valor:</strong>
								<input type="text" name="postcode" value="" class="form-control" placeholder="Valor">
						</div>
					</div>
					</td>
					
					
					</td><td>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Duração:</strong>
								<input type="text" name="postcode" value="" class="form-control" placeholder="Duração">
						</div>
					</div>
					</td><td>
					
					<a class="btn btn-success btn-big btn-add" id="add_test_button"><i class="glyphicon glyphicon-plus"></i></a>
					
					</td>
					
					
				</tr>
			</table>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Sub Categoria</th>
							<th>Valor</th>
							<th>Duração</th>
							<th colspan="2">Operação</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($activities as $item)
							<tr>
								<td>{{ $categories[DB::table('subtypes')->where('id', $item['subtype_id'])->value('type_id')].
										' --> '.
										$subcategories[$item['subtype_id']] }}</td>
								<td>{{$item['amount']}}</td>
								<td>{{$item['minutes']}}</td>
								<td>
									<form action="{{action('ProviderController@destroy', $item['id'])}}" method="post">
										@csrf
										<input name="_method" type="hidden" value="DELETE">
										<button class="btn btn-danger" type="submit">Apagar</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
			</div>
			
			
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>

        </div>


    </form>
@endsection
