@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>Veiculo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('veiculos.create') }}"> Novo Veiculo</a>
            </div>
        </div>
    </div>
    <x-alert></x-alert>

    <table class="table table-bordered">
        <tr>
            <th>Usúario</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Cor</th>
            <th>Tipo</th>
            <th width="280px">Ações</th>
        </tr>
        @foreach ($data as $key => $veiculo)
            <tr>
                <td>{{ $veiculo->usuario->name }}</td>
                <td>{{ $veiculo->placa }}</td>
                <td>{{ $veiculo->modelo }}</td>
                <td>{{ $veiculo->cor }}</td>
                <td>{{ $veiculo->tipo }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('veiculos.show', $veiculo->id) }}">Visualizar</a>
                    <a class="btn btn-primary" href="{{ route('veiculos.edit', $veiculo->id) }}">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['veiculos.destroy', $veiculo->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

@endsection
