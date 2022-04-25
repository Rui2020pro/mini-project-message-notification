@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Olá {{ Auth::user()->name }}</h4>
                    <p> Bem-vindo ao seu painel de gestão de mensagens e notificações.
                        Para começar, clique no botão abaixo para criar uma nova mensagem.
                        <a href="{{ route('mensagens.create') }}" class="btn btn-primary">
                            {{ __('Criar Mensagem') }}
                        </a>
                    </p>
                    <p> Para ver as mensagens existentes, clique no seguinte botão.
                        <a href="{{ route('mensagens.index') }}" class="btn btn-primary">
                            {{ __('Ver Mensagens') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
