@extends('adminlte::page')

@section('htmlheader_title')
	Edição
@endsection


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Atualizar Sub Categorias</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('subtype.index') }}"> Retornar</a>

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


{{ Form::open(array('route' => array('subtype.update',$subtype->id) , 'files' => true)) }}

        @csrf

        @method('PUT')


         <div class="row">
			 <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoria:</strong>
                    
                    {{ Form::select('type_id' , $categories , $subtype->type_id) }}

                </div>
            </div>
			 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Descrição:</strong>
                    <input type="text" name="description" value="{{ $subtype->description }}" class="form-control" placeholder="Descrição">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Imagem:</strong>

                    {{ Form::file('image') }}

                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Url da Imagem:</strong>
                    <input type="text" name="url_image" value="{{ $subtype->url_image }}" class="form-control" placeholder="URL da Imagem">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Visualização: </strong>
                    {{ Html::image($subtype['url_image'] , 'subtype' , ['title' => $subtype['url_image'], 'style'=> 'max-width:100%'])}}
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>

        </div>


    {{ Form::close() }}
@endsection
