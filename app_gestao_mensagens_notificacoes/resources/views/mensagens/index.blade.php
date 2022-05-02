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
                <th></th>
                <th>ID</th>
                <th>Mensagem</th>
                <th>Posição</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="table-list-messages-body">
            @foreach($mensagens as $mensagem)
            <tr class="table-row-messages" id="message-{{ $mensagem->id }}">
                <!-- sortable icon -->
                <td>
                    <i class="fas fa-sort"></i>
                </td>
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
                    <!-- Before delete msg , ask to the user with toast warning if he really wants to delete the msg -->
                    <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#modal-delete-msg-{{ $mensagem->id }}">
                        <i class="fa fa-trash"></i>
                        Excluir
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-delete-msg-{{$mensagem->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-msg-label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-delete-msg-label">Excluir Mensagem</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="btn btn-danger" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Deseja realmente excluir a mensagem?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form id="form-delete-msg" action="{{ route('mensagens.destroy', $mensagem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('sweetalert::alert')

@endsection