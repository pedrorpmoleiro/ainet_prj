<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <form method="get" role="form" action="{{ action('UserController@index') }}" >
                        <div class="row ml-2">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Número Socio" name="num_socio" value="{{old('id',strval($filters['num_socio']))}}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Nome Informal" name="nome_informal" value="{{old('id',strval($filters['nome_informal']))}}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="email" class="form-control" placeholder="email" name="email" value="{{old('id',strval($filters['email']))}}">
                            </div>
                            <div class="form-group mr-2">
                                <select class="form-control" name="tipo">
                                    <option value="A">Aeromodelista</option>
                                    <option value="NP">Não Piloto</option>
                                    <option value="P">Piloto</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ml-2">
                            @can('direcao')
                                <div  class="form-group mr-2">
                                    <select class="form-control" name="direcao">
                                        <option value="1">Direção</option>
                                        <option value="0">N/A</option>
                                    </select>
                                </div>
                            @endcan
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Quotas pagas" name="quotas_pagas">
                            </div>
                            <div  class="form-group mr-2">
                                <select class="form-control" name="ativo">
                                    <option value="1">Ativo</option>
                                    <option value="0">Desativado</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row ml-2">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>