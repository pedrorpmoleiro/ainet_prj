<script>
    function mostrar(value) {
        var ins = document.getElementById('data2');
        if (value == "duas_datas") {
            ins.style.display = 'block';
        } else {
            ins.style.display = 'none';
        }
    }
</script>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <form role="form" method="get" action="{{ action('MovimentoController@index') }}">
                        <div class="row ml-2">
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Id Movimento" name="id"
                                       value="{{old('id',strval($filters['id']))}}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Matricula Aeronave" name="aeronave"
                                       value="{{old('aeronave',strval($filters['aeronave'])??'')}}">
                            </div>
                            <div class="form-group mr-2">
                                <input type="text" class="form-control" placeholder="Piloto" name="piloto"
                                       value="{{ old('piloto',strval($filters['piloto'])) }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Instrutor" name="instrutor"
                                       value="{{ old('instrutor',strval($filters['instrutor'])) }}">
                            </div>
                        </div>
                        <div class="row ml-2">
                            <div class="form-group mr-2">
                                <select class="form-control" name="filter_day" onchange="mostrar(value)">
                                    <option {{ $filters['filter_day']== "anterior"? 'selected' : '' }} value="anterior">
                                        Anterior
                                    </option>
                                    <option {{ strval($filters['filter_day']) == "posterior"? 'selected' : '' }}  value="posterior">
                                        Posterior
                                    </option>
                                    <option {{ $filters['filter_day'] == "duas_datas"? 'selected' : '' }} value="duas_datas">
                                        Duas Datas
                                    </option>
                                    <option {{ $filters['filter_day'] == "data"? 'selected' : '' }} value="data">Data
                                        Certa
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <input type="date" class="form-control" name="data_inf"
                                       value="{{ old('data_inf',strval($filters['data_inf'])) }}">
                            </div>
                            <div class="form-group mr-2" style="display:none;" id="data2">
                                <input type="date" class="form-control" name="data_sup"
                                       value="{{ old('data_sup',strval($filters['data_sup'])) }}">
                            </div>
                            <div class="form-group mr-2">
                                <select class="form-control" name="natureza">
                                    <option {{ $filters['natureza'] == "T"? 'selected' : '' }}  value="T">Treino
                                    </option>
                                    <option {{ $filters['natureza'] == "E"? 'selected' : '' }} value="E">Especial
                                    </option>
                                    <option {{ $filters['natureza']== 'I'? 'selected' : '' }} value="I">Instrução
                                    </option>
                                    <option {{ $filters['natureza']== 'Todos'? 'selected' : '' }} value="Todos">Todos
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <select class="form-control" name="confirmado">
                                    <option @if($filters['confirmado'] == "1" || $filters['meus_movimentos'] == "Confirmados")selected
                                            @endif value="1">Confirmados
                                    </option>
                                    <option @if($filters['confirmado'] == "0" || $filters['meus_movimentos'] == "Não Confirmados") selected
                                            @endif value="0">Não Confirmados
                                    </option>
                                    <option @if($filters['confirmado'] == "A" || $filters['meus_movimentos'] == "Ambos")selected
                                            @endif value="A">Ambos
                                    </option>
                                </select>
                            </div>
                            @can('pilotoDirecao')
                                <div class="form-group mr-2">
                                    <select class="form-control" name="meus_movimentos">
                                        <option @if($filters['meus_movimentos'] == "N" || $filters['meus_movimentos'] == "Todos")selected
                                                @endif value="N">Todos
                                        </option>
                                        <option @if($filters['meus_movimentos'] == "S" || $filters['meus_movimentos'] == "Meus Movimentos" )selected
                                                @endif value="S">Meus Movimentos
                                        </option>
                                    </select>
                                </div>
                            @endcan
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