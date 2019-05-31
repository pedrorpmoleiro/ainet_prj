<div class="row justify-content-center">
    <div class="col-md-auto">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <form method="GET" action="{{ action('UserController@index') }}">
                        <div class="row ml-2">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Número Socio" name="num_socio"
                                       value="{{ old('id', (string) $filters['num_socio']) }}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Nome Informal" name="nome_informal"
                                       value="{{ old('id', (string) $filters['nome_informal']) }}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="email" class="form-control" placeholder="email" name="email"
                                       value="{{ old('id', (string) $filters['email']) }}">
                            </div>
                            <div class="form-group mr-2">
                                <select class="form-control" name="tipo">
                                    <option {{(string) $filters['tipo'] == "Todos"?'selected':'' }} value="Todos">
                                        Todos
                                    </option>
                                    <option @if( (string) $filters['tipo'] == "A" || (string) $filters['tipo'] == "Aeromodelista")selected
                                            @endif value="A">Aeromodelista
                                    </option>
                                    <option @if( (string) $filters['tipo'] == "NP" || (string) $filters['tipo'] == "Não Piloto")selected
                                            @endif value="NP">Não Piloto
                                    </option>
                                    <option @if( (string) $filters['tipo'] == "P" || (string) $filters['tipo'] == "Piloto")selected
                                            @endif value="P">Piloto
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row ml-2">
                            @can('direcao')
                                <div class="form-group mr-2">
                                    <select class="form-control" name="quotas_pagas">
                                        <option @if( (string) $filters['quotas_pagas'] == "1" || (string) $filters['quotas_pagas'] == "Quota Paga")selected
                                                @endif  value="1">Quota Paga
                                        </option>
                                        <option @if( (string) $filters['quotas_pagas'] == "0" || (string) $filters['quotas_pagas'] == "Quota Não Paga")selected
                                                @endif  value="0">Quota Não Paga
                                        </option>
                                        <option @if( (string) $filters['quotas_pagas'] == "A" || (string) $filters['quotas_pagas'] == "Ambos")selected
                                                @endif value="A">Ambos
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group mr-2">
                                    <select class="form-control" name="ativo">
                                        <option @if( (string) $filters['ativo'] == "1" || (string) $filters['ativo'] == "Ativo")selected
                                                @endif  value="1">Ativo
                                        </option>
                                        <option @if( (string) $filters['ativo'] == "0" || (string) $filters['ativo'] == "Desativado")selected
                                                @endif value="0">Desativado
                                        </option>
                                        <option @if( (string) $filters['ativo'] == "A" || (string) $filters['ativo'] == "Ambos")selected
                                                @endif value="A">Ambos
                                        </option>
                                    </select>
                                </div>
                            @endcan
                            <div class="form-group mr-2">
                                <select class="form-control" name="direcao">
                                    <option @if( (string) $filters['direcao'] == "1" || (string) $filters['direcao'] == "Direcão")selected
                                            @endif value="1">Direcão
                                    </option>
                                    <option @if( (string) $filters['direcao'] == "0" || (string) $filters['direcao'] == "N/A")selected
                                            @endif value="0">N/A
                                    </option>
                                    <option @if( (string) $filters['direcao'] == "A" || (string) $filters['direcao'] == "Ambos")selected
                                            @endif value="A">Ambos
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row ml-2">
                            <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>