<script>
    function mostrar(value) {
        var ins = document.getElementById('instrucao');
        if (value == 'I') {
            ins.style.display = 'block';
        } else {
            ins.style.display = 'none';
        }
    }

    function mostrarC() {
        var checkBox = document.getElementById("resolve");
        var text = document.getElementById("conflito");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>

<div class="form-group row">
    <label for="data" class="col-md-4 col-form-label text-md-right">Data de voo</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('data') is-invalid @enderror" name="data"
               value="{{ old('data', strval($movimento->data)) }}">

        @error('data')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="aeronave" class="col-md-4 col-form-label text-md-right">Aeronave</label>

    <div class="col-md-6">
        <select class="form-control" name="aeronave">
            @foreach($aeronaves as $aeronave)
                <option {{ old('aeronave', strval($movimento->aeronave)) == $aeronave->matricula ? 'selected' : '' }}> {{$aeronave->matricula}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="hora_descolagem" class="col-md-4 col-form-label text-md-right">Hora Descolagem</label>

    <div class="col-md-6">
        <input type="time" class="form-control @error('hora_descolagem') is-invalid @enderror" name="hora_descolagem"
               value="{{ old('hora_descolagem', date('H:j:s',strtotime($movimento->hora_descolagem))) }}">

        @error('hora_descolagem')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="hora_aterragem" class="col-md-4 col-form-label text-md-right">Hora Aterragem</label>

    <div class="col-md-6">
        <input type="time" class="form-control @error('hora_aterragem') is-invalid @enderror" name="hora_aterragem"
               value="{{ old('hora_aterragem', date('H:j:s',strtotime($movimento->hora_aterragem))) }}">
        @error('hora_aterragem')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="num_diario" class="col-md-4 col-form-label text-md-right">Número de Diario</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_diario') is-invalid @enderror" name="num_diario"
               value="{{ old('num_diario', strval($movimento->num_diario)) }}">

        @error('num_diario')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_servico" class="col-md-4 col-form-label text-md-right">Número de Serviço</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_servico') is-invalid @enderror" name="num_servico"
               value="{{ old('num_servico', strval($movimento->num_servico)) }}">

        @error('num_servico')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!--div class="form-group row">
    <label for="piloto_id" class="col-md-4 col-form-label text-md-right">Número de Piloto</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('piloto_id') is-invalid @enderror" name="piloto_id" value="{{ old('piloto_id', strval($movimento->piloto_id)) }}">

    </div>
</div-->
<div class="form-group row">
    <label for="natureza" class="col-md-4 col-form-label text-md-right">Natureza </label>

    <div class="col-md-6">
        <select class="form-control" name="natureza" onchange="mostrar(value)">
            <option value="T"
                    {{ old('natureza', strval($movimento->natureza)) == 'T' ? 'selected' : '' }} onclick="mostrar(1);">
                Treino
            </option>

            <option value="I"
                    {{ old('natureza', strval($movimento->natureza)) == 'I' ? 'selected' : '' }} onclick="mostrar(2);">
                Instrução
            </option>

            <option value="E"
                    {{ old('natureza', strval($movimento->natureza)) == 'E' ? 'selected' : '' }} onclick="mostrar(3);">
                Especial
            </option>

        </select>

    </div>
</div>
<div id="instrucao" style="display:none;">
    <div class="form-group row">
        <label for="instrutor_id" class="col-md-4 col-form-label text-md-right">Número do Instrutor</label>

        <div class="col-md-6">
            <select class="form-control" name="instrutor_id">
                @foreach($instrutores as $instrutor)
                    <option {{ old('instrutor_id', strval($movimento->instrutor_id)) == $instrutor->id ? 'selected' : '' }} value="{{ $instrutor->id}}"> {{$instrutor->id.'-'.$instrutor->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="tipo_instrucao" class="col-md-4 col-form-label text-md-right"> Tipo Instrucao </label>

        <div class="col-md-6">
            <input type="radio" name="tipo_instrucao"
                   value="D" {{ old('tipo_instrucao', strval($movimento->tipo_instrucao)) == 'D' ? 'checked' : '' }}>Duplo
            Comando <br>

            <input type="radio" name="tipo_instrucao"
                   value="S" {{ old('tipo_instrucao', strval($movimento->tipo_instrucao)) == 'S' ? 'checked' : '' }}>
            Solo

            @error('tipo_instrucao')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="aerodromo_partida" class="col-md-4 col-form-label text-md-right"> Aerodromo Partida</label>
    <div class="col-md-6">
        <select class="form-control" name="aerodromo_partida">
            @foreach($aerodromos as $aerodromo)
                <option {{ old('aerodromo_partida', strval($movimento->aerodromo_partida)) == $aerodromo->code ? 'selected' : '' }} value="{{ $aerodromo->code}}"> {{$aerodromo->nome}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="aerodromo_chegada" class="col-md-4 col-form-label text-md-right"> Aerodromo Chegada</label>

    <div class="col-md-6">
        <select class="form-control" name="aerodromo_chegada">
            @foreach($aerodromos as $aerodromo)
                <option {{ old('aerodromo_chegada', strval($movimento->aerodromo_chegada)) == $aerodromo->code ? 'selected' : '' }} value="{{ $aerodromo->code}}"> {{$aerodromo->nome}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="num_aterragens" class="col-md-4 col-form-label text-md-right">Número de Aterragens</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_aterragens') is-invalid @enderror" name="num_aterragens"
               value="{{ old('num_aterragens', strval($movimento->num_aterragens)) }}">

        @error('num_aterragens')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_descolagens" class="col-md-4 col-form-label text-md-right">Número Descolagens</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_descolagens') is-invalid @enderror" name="num_descolagens"
               value="{{ old('num_descolagens', strval($movimento->num_descolagens)) }}">

        @error('num_descolagens')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_pessoas" class="col-md-4 col-form-label text-md-right">Número de Pessoas</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_pessoas') is-invalid @enderror" name="num_pessoas"
               value="{{ old('num_pessoas', strval($movimento->num_pessoas)) }}">

        @error('num_pessoas')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="conta_horas_inicio" class="col-md-4 col-form-label text-md-right">Conta horas incio</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('conta_horas_inicio') is-invalid @enderror"
               name="conta_horas_inicio"
               value="{{ old('conta_horas_inicio', strval($movimento->conta_horas_inicio)) }}">

        @error('conta_horas_inicio')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="conta_horas_fim" class="col-md-4 col-form-label text-md-right">Conta horas de fim</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('conta_horas_fim') is-invalid @enderror" name="conta_horas_fim"
               value="{{ old('conta_horas_fim', strval($movimento->conta_horas_fim)) }}">

        @error('conta_horas_fim')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="flash-message">
            @foreach (['danger', 'warning'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="modo_pagamento" class="col-md-4 col-form-label text-md-right">Modo Pagamento </label>

    <div class="col-md-6">
        <select name="modo_pagamento" class="form-control">
            <option value="N" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'N' ? 'checked' : '' }}>
                Numerário
            </option>

            <option value="M" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'M' ? 'checked' : '' }}>
                Multibanco
            </option>

            <option value="T" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'T' ? 'checked' : '' }}>
                Transferência
            </option>

            <option value="P" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'P' ? 'checked' : '' }}>
                Pacote de horas

        </select>
    </div>
</div>
<div class="form-group row">
    <label for="num_recibo" class="col-md-4 col-form-label text-md-right"> Número de Recibo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_recibo') is-invalid @enderror" name="num_recibo"
               value="{{ old('num_recibo', strval($movimento->num_recibo)) }}">

        @error('num_recibo')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- si for DE INSTRUCAO  -->
<div class="form-group row">
    <label for="observacoes" class="col-md-4 col-form-label text-md-right"> Observacoes</label>
    <div class="col-md-6">
    <textarea rows="3" class="form-control @error('observacoes') is-invalid @enderror" name="observacoes">
{{ old('observacoes', strval($movimento->observacoes)) }}
        @error('observacoes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </textarea>
    </div>
</div>

<div>
    <label for="resolver" class="col-md-4 col-form-label text-md-right">Guardar com conflitos</label>
    <input type="checkbox" id="resolve" class="form-control-input" name="resolver" onclick="mostrarC()">
</div>
<div id="conflito" style="display:none;">
    <div class="form-group row">
        <label for="justificacao_conflito" class="col-md-4 col-form-label text-md-right"> Justificacao conflito</label>
        <div class="col-md-6">
        <textarea rows="3" class="form-control @error('justificacao_conflito') is-invalid @enderror"
                  name="justificacao_conflito">
            {{ old('justificacao_conflito', strval($movimento->justificacao_conflito)) }}
        </textarea>
            @error('justificacao_conflito')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>

</div>
