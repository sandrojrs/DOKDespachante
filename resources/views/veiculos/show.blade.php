@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2> Visualizar Veiculo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> Voltar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usúario:</strong>
                {{ $veiculo->usuario->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Veiculo:</strong>
                {{ $veiculo->veiculo }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Placa:</strong>
                {{ $veiculo->placa }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor:</strong>
                {{ $veiculo->cor }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor:</strong>
                {{ $veiculo->tipo }}
            </div>
        </div>
    </div>
@endsection
