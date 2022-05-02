@extends('layouts.app')

<!-- Editar Password -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="float-right" style="margin: 0px">{{ __('Editar Perfil') }}</h6>
                        <a href="{{ route('mensagens.index') }}" class="btn btn-primary">
                            {{ __('Voltar') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="new_password" type="password" class="form-control  @error('new_password"') is-invalid @enderror" name="new_password"" value="{{ $user->password ?? old('password') }}" required autocomplete="new_password"">

                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="show_new_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmação da Password') }}</label>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="input-group mt-2">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">

                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="show_password_confirm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mb-0 mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
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