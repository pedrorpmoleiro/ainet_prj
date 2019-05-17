<script>
    function mostrar(value){
        var ins=document.getElementById('data2');
        if(value=="duas_datas"){

            ins.style.display = 'block';
        }
        else{
            ins.style.display = 'none';
        }
    }
</script>
<div class="form-group row">
    <form class="form-inline" role="form" method="get" action="{{action('MovimentoController@index')}}" >
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Id Movimento" name="id" value="{{old('id',strval($filters['id']))}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Matricula Aeronave" name="aeronave" value="{{old('aeronave',strval($filters['aeronave']))}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Piloto" name="piloto" value="{{ old('piloto',strval($filters['piloto'])) }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Instrutor" name="instrutor" value="{{ old('instrutor',strval($filters['instrutor'])) }}">
        </div>
        <div class="form-group">
            <input type="date" class="form-control" name="data_inf" value="{{ old('data_inf',strval($filters['data_inf'])) }}">
        </div>
        <div class="form-group" style="display:none;" id="data2">
            <input type="date" class="form-control" name="data_sup" value="{{ old('data_sup',strval($filters['data_sup'])) }}">
        </div>
        <div  class="form-group">
            <select class="form-control" name="filter_day" onchange="mostrar(value)">
                <option {{ $filters['filter_day']== "anterior"? 'selected' : '' }} value="anterior">Anterior</option>
                <option {{ strval($filters['filter_day']) == "posterior"? 'selected' : '' }}  value="posterior">Posterior</option>
                <option {{ $filters['filter_day'] == "duas_datas"? 'selected' : '' }} value="duas_datas">Duas Datas</option>
            </select>
        </div>
        <div  class="form-group">
            <select class="form-control" name="natureza">
                <option {{$filters['natureza'] == "T"? 'selected' : '' }}  value="T">Treino</option>
                <option {{ $filters['natureza'] == "E"? 'selected' : '' }} value="E">Especial</option>
                <option {{ $filters['natureza']== 'I'? 'selected' : '' }} value="I">Instrução</option>
            </select>
        </div>
        <div  class="form-group">
            <select class="form-control" name="confirmado">
                <option value="1">Confirmados</option>
                <option value="0">Sin Confirmar</option>
            </select>
        </div>
        <div  class="form-group">
            <select class="form-control" name="meus_movimentos">
                <option value="N">Todos</option>
                <option value="S">Meus Movimentos</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
</div>