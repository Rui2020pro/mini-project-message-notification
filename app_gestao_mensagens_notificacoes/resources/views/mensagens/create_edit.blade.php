@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Formulário de criação de mensagens -->
            <div class="card">
                <div class="card-header">
                    @if(isset($mensagem))
                        Editar Mensagem
                    @else
                        Criar Mensagem
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($mensagem))
                        <form method="POST" action="{{ route('mensagens.update', $mensagem->id) }}">
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('mensagens.store') }}">
                    @endif
                    
                        @csrf

                        <div class="form-group row">
                            <label for="mensagem" class="col-md-4 col-form-label text-md-right">{{ __('Mensagem') }}</label>

                            <div class="col-md-6">
                                <textarea id="mensagem" type="text" class="form-control @error('mensagem') is-invalid @enderror" name="mensagem" value="{{ $mensagem->mensagem ?? old('mensagem') }}" required autocomplete="mensagem" autofocus>{{ $mensagem->mensagem ?? old('mensagem') }}</textarea>

                                @error('mensagem')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar Mensagem') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
