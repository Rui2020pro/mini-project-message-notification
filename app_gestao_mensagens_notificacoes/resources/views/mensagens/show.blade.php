@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Formulário de exibição de mensagens com o botão de edição e voltar para trás -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="float-right" style="margin: 0px">{{ __('Exibir Mensagem') }}</h6>
                    <a href="{{ route('mensagens.index') }}" class="btn btn-primary">
                        {{ __('Voltar') }}
                    </a>
                </div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <textarea id="mensagem" type="text" class="form-control" name="mensagem" value="{{ old('mensagem') ?? $mensagem->mensagem }}" disabled>{{ $mensagem->mensagem }}</textarea>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
