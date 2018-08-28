@extends('adminlte::page')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Adicionar Novo Banner</h2>

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

	{{ Form::open(array('route' => 'banner.store','files' => true)) }}

        @csrf


         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{ Form::text('name', '' ,['class' => 'form-control','placeholder' => 'Nome' , 'required' ]) }}
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
                    <strong>Categoria:</strong>
                           {{ Form::select('type_id' , $categories ) }}
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sub-Categoria:</strong>
                           {{ Form::select('subtype_id' , $subcategories ) }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>

    {{ Form::close() }}
@endsection
