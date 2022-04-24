@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique o seu Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para seu endereço de email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, verifique seu email para obter um link de verificação.') }}
                    {{ __('Se não recebeu o seu email, ') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('por favor clique aqui') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
