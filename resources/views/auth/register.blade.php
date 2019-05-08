@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h3 class="row justify-content-center mb-4">Após o registro verifique o seu email!</h3>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome Completo</label>
                        
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nome_informal" class="col-md-4 col-form-label text-md-right">Nome Informal</label>
                        
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nome_informal') is-invalid @enderror" name="nome_informal" value="{{ old('nome_informal') }}">
                        
                                @error('nome_informal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="sexo" class="col-md-4 col-form-label text-md-right">Género</label>
                        
                            <div class="col-md-6">
                                <input type="radio" name="sexo" value="M" {{ old('sexo') == 'M' ? 'checked' : '' }}>Masculino<br>
                                
                                <input type="radio" name="sexo" value="F" {{ old('sexo') == 'F' ? 'checked' : '' }}>Feminino
                                
                                @error('sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
                        
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento') }}">
                        
                                @error('data_nascimento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">NIF</label>
                        
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}">
                        
                                @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">Telefone</label>
                        
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}">
                        
                                @error('telefone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">Endereço</label>
                        
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco') }}">
                        
                                @error('endereco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- TIPO SOCIO RADIO -->
                        <div class="form-group row">
                            <label for="tipo_socio" class="col-md-4 col-form-label text-md-right">Tipo de Sócio</label>
                        
                            <div class="col-md-6">
                                <input type="radio" name="tipo_socio" value="P" {{ old('tipo_socio') == 'P' ? 'checked' : '' }}>Piloto<br>
                                
                                <input type="radio" name="tipo_socio" value="NP" {{ old('tipo_socio') == 'NP' ? 'checked' : '' }}>Não Piloto<br>
                                
                                <input type="radio" name="tipo_socio" value="A" {{ old('tipo_socio') == 'A' ? 'checked' : '' }}>Aeromodelista
                        
                                @error('tipo_socio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
