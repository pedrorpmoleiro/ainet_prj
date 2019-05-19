<div class="form-group row">
    <form class="form-inline" role="form" method="get" action="{{action('UserController@index')}}" >
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Número Socio" name="num_socio" value="{{old('id',strval($filters['num_socio']))}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nome Informal" name="nome_informal" value="{{old('id',strval($filters['nome_informal']))}}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="email" name="email" value="{{old('id',strval($filters['email']))}}">
        </div>
        <div class="form-group">
            <select class="form-control" name="tipo">
                <option value="A">Aeromodelista</option>
                <option value="NP">Não Piloto</option>
                <option value="P">Piloto</option>
            </select>
        </div>
        <div  class="form-group">
            <select class="form-control" name="direcao">
                <option value="1">Com Direcao</option>
                <option value="0">Sim Direcao</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Quotas pagas" name="quotas_pagas">
        </div>
        <div  class="form-group">
            <select class="form-control" name="ativo">
                <option value="1">Ativo</option>
                <option value="0">Desativado</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
</div>