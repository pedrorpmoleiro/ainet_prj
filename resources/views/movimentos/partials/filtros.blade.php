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
            <input type="text" class="form-control" placeholder="Id Movimento" name="id" value="{{old('id',isset($filters['id'])==true?strval($filters['id']):'')}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Matricula Aeronave" name="aeronave" value="{{old('aeronave',isset($filters['aeronave'])==true?strval($filters['aeronave']):'')}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Piloto" name="piloto" value="{{ old('piloto',isset($filters['piloto'])==true?strval($filters['piloto']):'') }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Instrutor" name="instrutor" value="{{ old('instrutor',isset($filters['instrutor'])==true?strval($filters['instrutor']):'') }}">
        </div>
        <div class="form-group">
            <input type="date" class="form-control" name="data_inf" value="{{old('data_inf')}}">
        </div>
        <div class="form-group" style="display:none;" id="data2" name="data_sup" value="{{old('data_sup')}}">
            <input type="date" class="form-control">
        </div>
        <div  class="form-group">
            <select class="form-control" name="filter_day" onchange="mostrar(value)">
                <option value="posterior">Posterior</option>
                <option value="anterior">Anterior</option>
                <option value="duas_datas">Duas Datas</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
</div>