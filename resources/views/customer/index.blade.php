@extends('adminlte::page')

@section('title', 'Escopo 1')


@section('content')
        <div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

				<div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Clientes</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
	
	@if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif
						
	<table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Ativ</th>
        <th colspan="2">Operação</th>
      </tr>
    </thead>
    <tbody>
		
	 @foreach($customer as $passport)
      @php
        $date=date('Y-m-d', $passport['date']);
        @endphp
      <tr>
        <td>{{$passport['name']}}</td>
        <td>{{$passport['email']}}</td>
        <td>{{$passport['address']}}</td>
        
        <td><a href="{{action('CustomerController@edit', $passport['id'])}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form action="{{action('CustomerController@destroy', $passport['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Apagar</button>
          </form>
        </td>
      </tr>
      @endforeach
		
		 </tbody>
  </table>
{!! $customer->links() !!}
                <div class="pull-right">

                <a class="btn btn-success" href="{{ route('customer.create') }}"> Cadastrar Novo</a>

				</div>
                    </div>
                    <!-- /.box-body -->
                </div>
			</div>
		</div>
	</div>
@stop
