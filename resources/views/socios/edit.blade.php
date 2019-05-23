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
                        <form action="{{ action('UserController@update', ['socio'=>$socio->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Foto de Perfil</label>

                                <div class="col-md-6">
                                    @if ($socio->foto_url)
                                        <img class="img rounded mx-auto d-block border border-secondary" width="100"
                                             src="{{ asset("storage/fotos/$socio->foto_url") }}">
                                    @else
                                        <img class="img rounded mx-auto d-block border border-secondary" width="100"
                                             src="{{ asset("storage/avatar_placeholder.png") }}">
                                    @endif
                                </div>
                            </div>

                            @include('socios.partials.add-edit')

                            <div class="form-group row">
                                <label for="quota_paga" class="col-md-4 col-form-label text-md-right">Quota Paga</label>

                                <div class="col-md-6">
                                    @if (Auth::user()->direcao)
                                        <input type="radio" name="quota_paga"
                                               value="1" {{ old('quota_paga', (string) $socio->quota_paga) == '1' ? 'checked' : '' }}>Sim<br>

                                        <input type="radio" name="quota_paga"
                                               value="0" {{ old('quota_paga', (string) $socio->quota_paga) == '0' ? 'checked' : '' }}>Não
                                    @else
                                        <input type="hidden" name="quota_paga" value="{{ $socio->quota_paga }}">
                                        @if ($socio->quota_paga)
                                            <p>Sim</p>
                                        @else
                                            <p>Não</p>
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="direcao" class="col-md-4 col-form-label text-md-right">Direção</label>

                                <div class="col-md-6">
                                    @if (Auth::user()->direcao)
                                        <input type="radio" name="direcao"
                                               value="1" {{ old('direcao', (string) $socio->direcao) == '1' ? 'checked' : '' }}>Sim<br>

                                        <input type="radio" name="direcao"
                                               value="0" {{ old('direcao', (string) $socio->direcao) == '0' ? 'checked' : '' }}>Não
                                    @else
                                        <input type="hidden" name="direcao" value="{{ $socio->direcao }}">
                                        @if ($socio->direcao)
                                            <p>Sim</p>
                                        @else
                                            <p>Não</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ativo" class="col-md-4 col-form-label text-md-right">Ativo</label>

                                <div class="col-md-6">
                                    @if (Auth::user()->direcao)
                                        <input type="radio" name="ativo"
                                               value="1" {{ old('ativo', (string) $socio->ativo) == '1' ? 'checked' : '' }}>Sim<br>

                                        <input type="radio" name="ativo"
                                               value="0" {{ old('ativo', (string) $socio->ativo) == '0' ? 'checked' : '' }}>Não
                                    @else
                                        <input type="hidden" name="ativo" value="{{ $socio->ativo }}">
                                        @if ($socio->ativo)
                                            <p>Sim</p>
                                        @else
                                            <p>Não</p>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            @can('pilotoDirecao')
                                <div class="form-group row">
                                    <label for="instrutor"
                                           class="col-md-4 col-form-label text-md-right">Instrutor</label>

                                    <div class="col-md-6">
                                        @cannot('direcao')
                                            <input type="hidden" name="instrutor" value="{{ $socio->instrutor }}">
                                            @if ($socio->instrutor)
                                                <p>Sim</p>
                                            @else
                                                <p>Não</p>
                                            @endif
                                        @endcannot
                                        @can('direcao')
                                            <input type="radio" name="instrutor"
                                                   value="1" {{ old('instrutor', (string) $socio->instrutor) == '1' ? 'checked' : '' }}>
                                            Sim<br>
                                            <input type="radio" name="instrutor"
                                                   value="0" {{ old('instrutor', (string) $socio->instrutor) == '0' ? 'checked' : '' }}>
                                            Não
                                        @endcan
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Numero de Licença</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('num_licenca') is-invalid @enderror" name="num_licenca" value="{{ old('num_licenca', (string) $socio->num_licenca) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Tipo Licenca</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="tipo_licenca">
                                            @foreach($tipos_licenca as $tipo)
                                                <option value="{{ $tipo->code }}" {{ old('tipo_licenca', (string) $socio->tipo_licenca) == (string) $tipo->code ? 'selected' : '' }} >{{ $tipo->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Validadde da Licença</label>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control @error('validade_licenca') is-invalid @enderror" name="validade_licenca" value="{{ old('validade_licenca', (string) $socio->validade_licenca) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Licenca Confirmada</label>

                                    <div class="col-md-6">
                                        @if (Auth::user()->direcao)
                                            <input type="radio" name="licenca_confirmada"
                                                   value="1" {{ old('licenca_confirmada', (string) $socio->licenca_confirmada) == '1' ? 'checked' : '' }}>Sim<br>

                                            <input type="radio" name="licenca_confirmada"
                                                   value="0" {{ old('licenca_confirmada', (string) $socio->licenca_confirmada) == '0' ? 'checked' : '' }}>Não
                                        @else
                                            <input type="hidden" name="licenca_confirmada" value="{{ $socio->licenca_confirmada }}">
                                            @if ($socio->licenca_confirmada)
                                                <p>Sim</p>
                                            @else
                                                <p>Não</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_licenca" class="col-md-4 col-form-label text-md-right">Alterar Licença</label>

                                    <div class="col-md-6">
                                        <input id="file_licenca" type="file" class="form-control-file" name="file_licenca" accept="application/pdf">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Numero do Certificado</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('num_certificado') is-invalid @enderror" name="num_certificado" value="{{ old('num_certificado', (string) $socio->num_certificado) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Classe do Certificado</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="classe_certificado">
                                            @foreach($classes_certificados as $classe)
                                                <option value="{{ $classe->code }}" {{ old('classe_certificado', (string) $socio->classe_certificado) == (string) $classe->code ? 'selected' : '' }} >{{ $classe->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Validadde do Certificado</label>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control @error('validade_certificado') is-invalid @enderror" name="validade_certificado" value="{{ old('validade_certificado', (string) $socio->validade_certificado) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Certificado Confirmado</label>

                                    <div class="col-md-6">
                                        @if (Auth::user()->direcao)
                                            <input type="radio" name="certificado_confirmado"
                                                   value="1" {{ old('certificado_confirmado', (string) $socio->certificado_confirmado) == '1' ? 'checked' : '' }}>Sim<br>

                                            <input type="radio" name="certificado_confirmado"
                                                   value="0" {{ old('certificado_confirmado', (string) $socio->certificado_confirmado) == '0' ? 'checked' : '' }}>Não
                                        @else
                                            <input type="hidden" name="certificado_confirmado" value="{{ $socio->certificado_confirmado }}">
                                            @if ($socio->certificado_confirmado)
                                                <p>Sim</p>
                                            @else
                                                <p>Não</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_certificado" class="col-md-4 col-form-label text-md-right">Alterar Certificado</label>

                                    <div class="col-md-6">
                                        <input id="file_certificado" type="file" class="form-control-file" name="file_certificado" accept="application/pdf">
                                    </div>
                                </div>
                            @endcan

                            @can ('direcao')
                                <div class="form-group row">
                                    <label for="aluno" class="col-md-4 col-form-label text-md-right">Aluno</label>

                                    <div class="col-md-6">
                                        <input type="radio" name="aluno"
                                               value="1" {{ old('aluno', (string) $socio->aluno) == '1' ? 'checked' : '' }}>Sim<br>

                                        <input type="radio" name="aluno"
                                               value="0" {{ old('aluno', (string) $socio->aluno) == '0' ? 'checked' : '' }}>Não
                                    </div>
                                </div>
                            @endcan

                            <div class="form-group row mb-2">
                                <div class="col-md-8 offset-md-4">
                                    @can('pilotoDirecao')
                                        <a class="btn btn-link"
                                           href="{{ action('UserController@licenca', ['piloto' => $socio->id]) }}">Ver
                                            Licença</a>
                                        <a class="btn btn-link"
                                           href="{{ action('UserController@certificado', ['piloto' => $socio->id]) }}">Ver
                                            Certificado</a>
                                    @endcan
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <div class="col-md-8 offset-md-4">
                                    @if ($socio->ativo == 0)
                                        <a class="btn btn-link"
                                           href="{{ action('UserController@sendReActivationEmail', ['socio'=>$socio->id]) }}">Reenviar
                                            email de validação</a>
                                    @endif

                                    @if ($socio->id == Auth::user()->id)
                                        <a class="btn btn-link" href="{{ action('UserController@alterarPassword') }}">Alterar
                                            Senha</a>
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
