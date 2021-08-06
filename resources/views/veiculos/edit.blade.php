@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>Atualização de Veiculos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('veiculos.index') }}">Voltar</a>
            </div>
        </div>
    </div>

    <x-alert></x-alert>

    {!! Form::model($veiculos, ['method' => 'PATCH', 'route' => ['veiculos.update', $veiculos->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Placa:</strong>
                {!! Form::text('placa', null, ['placeholder' => 'Placa', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modelo:</strong>
                {!! Form::text('modelo', null, ['placeholder' => 'Modelo', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor:</strong>
                {!! Form::text('cor', null, ['placeholder' => 'Cor', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo:</strong>
                <Select class="form form-control" name="tipo">
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>
                </Select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
