@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between">
        <h3>Lista de Mensagens</h3>
        <a href="{{ route('mensagens.create') }}" class="btn btn-primary">
            {{ __('Nova Mensagem') }}
        </a>
    </div>

    <!-- Table -->
    <table class="table table-striped table-bordered table-hover table-condensed" id="table-list-messages">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensagem</th>
                <th>Posição</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensagens as $mensagem)
            <tr>
                <td>{{ $mensagem->id }}</td>
                <td>{{ $mensagem->mensagem }}</td>
                <td>{{ $mensagem->position }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($mensagem->created_at)) }}</td>
                <td>
                    <a href="{{ route('mensagens.show', $mensagem->id) }}" class="btn btn-primary btn-xs" data-id="{{ $mensagem->id }}" data-url="{{ route('mensagens.show', $mensagem->id) }}">
                        <i class="fa fa-eye"></i>
                        Visualizar
                    </a>
                    <a href="{{ route('mensagens.edit', $mensagem->id) }}" class="btn btn-warning btn-xs" data-id="{{ $mensagem->id }}" data-url="{{ route('mensagens.edit', $mensagem->id) }}">
                        <i class="fa fa-pencil"></i>
                        Editar
                    </a>
                    <a href="{{ route('mensagens.destroy', $mensagem->id) }}" class="btn btn-danger btn-xs" data-id="{{ $mensagem->id }}" data-url="{{ route('mensagens.destroy', $mensagem->id) }}">
                        <i class="fa fa-trash"></i>
                        Excluir
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection