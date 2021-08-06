@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="pull-left">
                <h2>Usuarios</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('usuarios.create') }}"> Novo Usúario</a>
            </div>
        </div>
    </div>

    <x-alert></x-alert>

    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th width="280px">Ações</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('usuarios.show', $user->id) }}">Visualizar</a>
                    <a class="btn btn-primary" href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['usuarios.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {{-- {!! $data->links() !!} --}}

@endsection
