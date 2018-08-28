@extends('adminlte::page')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar Novo Prestador de Serviço</h2>
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


    <form action="{{ route('provider.store') }}" method="POST">

        @csrf


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Nome" required>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefone Fixo:</strong>
                    <input type="text" name="home_phone" class="form-control" placeholder="Telefone Fixo">
                </div>
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefone Celular:</strong>
                    <input type="text" name="mobile_phone" class="form-control" placeholder="Telefone Celular">
                </div>
            </div>

			<center>
			<table border=0>
				<tr>


					<td>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>RG:</strong>
                    <input type="text" name="rg" class="form-control" placeholder="RG">
                </div>
            </div>
					</td>

					<td>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>CPF:</strong>
                    <input type="text" name="cpf" class="form-control" placeholder="CPF">
                </div>
            </div>
					</td>

				</tr>
			</table>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>


    </form>


@endsection
