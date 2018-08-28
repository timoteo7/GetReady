@extends('adminlte::page')

@section('content')

	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Pedidos</h3>
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
									<th>Cliente</th>
									<th>Atividade</th>
									<th>Valor</th>
									<th>Minutos</th>
                                    <th>Prestador</th>
                                    <th>Agendamento</th>
                                    <th>Status</th>
									<th colspan="2">Operações</th>
								</tr>
							</thead>
							<tbody>
						 	@foreach($orders as $order)
								<tr>
									<td>{{$order->customer['name']  }}</td>
									<td>{{$order->activity->subtype['description']}}</td>
									<td>R$ {{ number_format( ($order->activity['amount']) ,2,',','.') }}</td>
									<td>{{$order->activity['minutes'] }}</td>
                                    <td>{{$order->activity->provider['name']}}</td>
                                    <td>{{ date('d/m/Y h:i:s',strtotime($order['schedule'])) }}</td>
                                    <td>{{$order['status']}}</td>
									
									<td>
										<form action="{{action('OrderController@destroy', $order['id'])}}" method="post">
											@csrf
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-danger" type="submit">Apagar</button>
										</form>
									</td>
								</tr>
								@endforeach
			 				</tbody>
						</table>
						{!! $orders->links() !!}
						<div class="pull-right">
	
							
	
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</div>
@endsection

