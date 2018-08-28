@extends('adminlte::page')

@section('content')


	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Cupons</h3>
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
									<th>Código</th>
									<th>Valor</th>
									<th>Porcentagem</th>
									<th>Validade Inicial</th>
                                    <th>Validade Final</th>
                                    <th>Status</th>
									<th colspan="2">Operações</th>
								</tr>
							</thead>
							<tbody>
						 	@foreach($coupons as $coupon)
								<tr>
									<td>{{ $coupon['code']  }}</td>
									<td>{{ empty ($coupon['value']) ?"" : number_format($coupon['value'],2,',','.') }}</td>
									<td>{{ empty ($coupon['percentage']) ? "" : $coupon['percentage'].'%'  }}</td>
									<td>{{ empty ($coupon['validity_start']) ? "" : date('d/m/Y',strtotime($coupon['validity_start'])) }}</td>
									<td>{{ empty ($coupon['validity_end']) ? "" : date('d/m/Y',strtotime($coupon['validity_end'])) }}</td>
                                    <td>{{ ($coupon['status']=='ACTIVE') ? "Ativo" : $coupon['status']  }}</td>
									
									<td><a href="{{action('CouponController@edit', $coupon['id'])}}" class="btn btn-warning">Editar</a></td>
									<td>
										<form action="{{action('CouponController@destroy', $coupon['id'])}}" method="post">
											@csrf
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-danger" type="submit">Apagar</button>
										</form>
									</td>
								</tr>
								@endforeach
			 				</tbody>
						</table>
						{!! $coupons->links() !!}
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('coupon.create') }}"> Cadastrar Nova</a>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</div>

@endsection

