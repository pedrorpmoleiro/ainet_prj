@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <h2>{{ $title }}</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ action('UserController@update', ['socio'=>$socio->id]) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $socio->id }}">
                        <input type="hidden" name="password" value="{{ $socio->password }}">

                        @include('socios.partials.add-edit')

                        <div class="form-group row">
                            <label for="quota_paga" class="col-md-4 col-form-label text-md-right">Quota Paga</label>

                            <div class="col-md-6">
                                @if ($socio->quota_paga)
                                    <p>Sim</p>
                                @else
                                    <p>Não</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="direcao" class="col-md-4 col-form-label text-md-right">Direção</label>

                            <div class="col-md-6">
                                @if ($socio->direcao)
                                    <p>Sim</p>
                                @else
                                    <p>Não</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ativo" class="col-md-4 col-form-label text-md-right">Ativo</label>

                            <div class="col-md-6">
                                @if ($socio->ativo)
                                    <p>Sim</p>
                                @else
                                    <p>Não</p>
                                @endif
                            </div>
                        </div>

                        @can('piloto')
                            <div class="form-group row">
                                <label for="instrutor" class="col-md-4 col-form-label text-md-right">Instrutor</label>

                                <div class="col-md-6">
                                    <input type="radio" name="instrutor" value="1" {{ old('instrutor', strval($socio->instrutor)) == '1' ? 'checked' : '' }}>Sim<br>

                                    <input type="radio" name="instrutor" value="0" {{ old('instrutor', strval($socio->instrutor)) == '0' ? 'checked' : '' }}>Não
                                </div>
                            </div>

                        @endcan

                        @can ('direcao')
                            <div class="form-group row">
                                <label for="aluno" class="col-md-4 col-form-label text-md-right">Aluno</label>

                                <div class="col-md-6">
                                    <input type="radio" name="aluno" value="1" {{ old('aluno', strval($socio->aluno)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="aluno" value="0" {{ old('aluno', strval($socio->aluno)) == '0' ? 'checked' : '' }}>Não

                                </div>
                            </div>
                        @endcan

                        <div class="form-group row mb-2">
                            <div class="col-md-8 offset-md-4">
                                @if ($socio->ativo == 0)
                                    <a class="btn btn-link" href="{{ action('UserController@sendReActivationEmail', ['socio'=>$socio->id]) }}">Reenviar email de validação</a>
                                @endif

                                @if ($socio->id == Auth::user()->id)
                                    <a class="btn btn-link" href="{{ action('UserController@alterarPassword') }}">Alterar Senha</a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection