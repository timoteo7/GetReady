@extends('adminlte::page')

@section('title', 'Escopo 1')

@section('content')
        <div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

				<div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub-Categorias</h3>
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
        <th>Categoria</th>
        <th>Descrição</th>
        <th>Imagem</th>
        <th>Qtd Ativ.</th>
        <th>Valor Médio</th>
        <th>Duração Média</th>
        <th colspan="2">Operações</th>
      </tr>
    </thead>
    <tbody>
		
	 @foreach($subtype as $passport)
      @php
        $date=date('Y-m-d', $passport['date']);
      @endphp
      <tr>
        <td>{{ $categories[$passport['type_id']] }}</td>
        <td>{{$passport['description']}}</td>
        <td>{{ Html::image($passport['url_image'] , 'image' ,['title' => $passport['url_image'], 'style'=> 'max-width:100%;max-height:100px;' ])}}</td>
        <td>{{ DB::table('activities')->where('subtype_id', $passport['id'])->count() }}</td>
        <td>{{ number_format(DB::table('activities')->where('subtype_id', $passport['id'])->avg('amount'),2, ',', '.') }}</td>
        <td>{{ number_format(DB::table('activities')->where('subtype_id', $passport['id'])->avg('minutes'),1, ',', '.') }}</td>
        
        <td><a href="{{action('SubtypeController@edit', $passport['id'])}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form action="{{action('SubtypeController@destroy', $passport['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Apagar</button>
          </form>
        </td>
      </tr>
      @endforeach
		
		 </tbody>
  </table>
{!! $subtype->links() !!}
                <div class="pull-right">

                <a class="btn btn-success" href="{{ route('subtype.create') }}"> Cadastrar Nova</a>

				</div>
                    </div>
                    <!-- /.box-body -->
                </div>
			</div>
		</div>
	</div>
@stop
