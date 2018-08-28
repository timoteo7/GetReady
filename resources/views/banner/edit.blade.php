@extends('adminlte::page')

@section('htmlheader_title')
	Edição
@endsection


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Atualizar Banner</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('banner.index') }}"> Retornar</a>

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

    {{ Form::open(array('route' => array('banner.update',$banner->id) , 'files' => true)) }}
    <!--form action="{{ route('banner.update',$banner->id) }}" method="POST"-->

        @csrf

        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="name" value="{{ $banner->name }}" class="form-control" placeholder="Nome" required>
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
                    <strong>URL da Imagem:</strong>
                    {{ Form::text('url_image', $banner->url_image ,['class' => 'form-control','placeholder' => 'URL' ]) }}

                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Visualização: </strong>
                    {{ Html::image($banner['url_image'] , 'banner' , ['title' => $banner['url_image'], 'style'=> 'max-width:100%'])}}
                </div>
            </div>

					

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoria:</strong>
                           {{ Form::select('type_id' , $categories , $banner->type_id) }}
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sub-Categoria:</strong>
                           {{ Form::select('subtype_id' , $subcategories , $banner->subtype_id) }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>

    {{ Form::close() }}
    </form>
@endsection
