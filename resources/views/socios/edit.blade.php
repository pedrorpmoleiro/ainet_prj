@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form action="{{ action('UserController@update', ['socio'=>$socio->id]) }}" method="post">
                            @method('put')
                            @csrf

                            <input type="hidden" name="id" value="{{ $socio->id }}">
                            <input type="hidden" name="password" value="{{ $socio->password }}">

                            @include('socios.partials.add-edit')

                            <!-- DIRECAO // ESCONDIDO DO UTILIZADOR NORMAL -->
                            <!-- QUOTA PAGA RADIO -->
                            <div class="form-group row">
                                <label for="quota_paga" class="col-md-4 col-form-label text-md-right">Quota Paga</label>

                                <div class="col-md-6">
                                    <input type="radio" name="quota_paga" value="1" {{ old('quota_paga', strval($socio->quota_paga)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="quota_paga" value="0" {{ old('quota_paga', strval($socio->quota_paga)) == '0' ? 'checked' : '' }}>Não
        
                                    @error('quota_paga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- DIRECAO RADIO -->
                            <div class="form-group row">
                                <label for="direcao" class="col-md-4 col-form-label text-md-right">Direção</label>

                                <div class="col-md-6">
                                    <input type="radio" name="direcao" value="1" {{ old('direcao', strval($socio->direcao)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="direcao" value="0" {{ old('direcao', strval($socio->direcao)) == '0' ? 'checked' : '' }}>Não
        
                                    @error('direcao')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- INSTRUTOR RADIO -->
                            <div class="form-group row">
                                <label for="instrutor" class="col-md-4 col-form-label text-md-right">Instrutor</label>

                                <div class="col-md-6">
                                    <input type="radio" name="instrutor" value="1" {{ old('instrutor', strval($socio->instrutor)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="instrutor" value="0" {{ old('instrutor', strval($socio->instrutor)) == '0' ? 'checked' : '' }}>Não

                                    @error('instrutor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- ALUNO RADIO -->
                            <div class="form-group row">
                                <label for="aluno" class="col-md-4 col-form-label text-md-right">Aluno</label>

                                <div class="col-md-6">
                                    <input type="radio" name="aluno" value="1" {{ old('aluno', strval($socio->aluno)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="aluno" value="0" {{ old('aluno', strval($socio->aluno)) == '0' ? 'checked' : '' }}>Não
        
                                    @error('aluno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- ATIVO -->
                            <div class="form-group row">
                                <label for="ativo" class="col-md-4 col-form-label text-md-right">Ativo</label>

                                <div class="col-md-6">
                                    <input type="radio" name="ativo" value="1" {{ old('ativo', strval($socio->ativo)) == '1' ? 'checked' : '' }}>Sim<br>
        
                                    <input type="radio" name="ativo" value="0" {{ old('ativo', strval($socio->ativo)) == '0' ? 'checked' : '' }}>Não
        
                                    @error('ativo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
</div>
@endsection