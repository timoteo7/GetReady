@extends('adminlte::page')

@section('title', 'GetReady')

@section('content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
				
				<div style="width: 100%; height: 700px; border: 1px solid gray; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					{!! Mapper::render() !!}
				</div>

                <!-- /.box-body -->
            </div>
		</div>
	</div>
@stop
