@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Table -->
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensagem</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensagens as $mensagem)
            <tr>
                <td>{{ $mensagem->id }}</td>
                <td>{{ $mensagem->mensagem }}</td>
                <td>{{ $mensagem->created_at }}</td>
                <td>
                    <a href="{{ route('mensagens.show', $mensagem->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-eye"></i>
                        Visualizar
                    </a>
                    <a href="{{ route('mensagens.edit', $mensagem->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>
                    <a href="{{ route('mensagens.destroy', $mensagem->id) }}" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection