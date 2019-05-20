<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <form role="form" method="get" action="{{action('UserController@index')}}" >
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
                                    <option @if($filters['tipo'] == "A" || $filters['tipo'] == "Aeromodelista")selected @endif value="A">Aeromodelista</option>
                                    <option @if($filters['tipo'] == "NP" || $filters['tipo'] == "Não Piloto")selected @endif value="NP">Não Piloto</option>
                                    <option @if($filters['tipo'] == "P" || $filters['tipo'] == "Piloto")selected @endif value="P">Piloto</option>
                                    <option @if($filters['tipo'] == "T" || $filters['tipo'] == "Todos")selected @endif value="T">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ml-2">
                            <div  class="form-group mr-2">
                                <select class="form-control" name="direcao">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
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