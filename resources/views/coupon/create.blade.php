@extends('adminlte::page')

@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Atualizar Cupom</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('coupon.index') }}"> Retornar</a>
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


<form action="{{ route('coupon.store') }}" method="POST">
@csrf

 <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Código Cupom:</strong>
            <input type="text" name="code" value="{{$code}}" class="form-control" placeholder="Descrição" required>
        </div>
    </div>
     
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Valor:</strong>
            <input type="number" step='any' name="value" value="" class="form-control" placeholder="Valor">
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Porcentagem:</strong>
            <input type="number" step='any' name="percentage" value="" class="form-control" placeholder="Porcentagem">
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Validade Inicial:</strong>
            <input type="date" name="validity_start" value="" class="form-control" placeholder="Validade Inicial">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Validade Final:</strong>
            <input type="date" name="validity_end" value="" class="form-control" placeholder="Validade Final">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
</form>


@endsection

