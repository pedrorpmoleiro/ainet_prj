<script>
    function mostrar(value) {
        var ins = document.getElementById('instrucao');
        if (value == 'I') {
            ins.style.display = 'block';
        } else {
            ins.style.display = 'none';
        }
    }

    window.onload = function () {
        mostrar("{{ $movimento->natureza }}");
        if ("{{$movimento->justificacao_conflito}}" != "") {
            check();
            mostrarC();
        }
    };

    function mostrarC() {
        var checkBox = document.getElementById("resolve");
        var text = document.getElementById("conflito");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }

    function check() {
        var checkBox = document.getElementById("resolve");
        checkBox.checked = true;
    }
</script>

<div class="form-group row">
    <label for="data" class="col-md-4 col-form-label text-md-right">Data de voo</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('data') is-invalid @enderror" name="data"
               value="{{ old('data', (string) $movimento->data) }}">

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
                <option {{ old('aeronave', (string) $movimento->aeronave) == $aeronave->matricula ? 'selected' : '' }}> {{$aeronave->matricula}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="piloto_id" class="col-md-4 col-form-label text-md-right">Piloto</label>

    <div class="col-md-6">
        <select class="form-control" name="piloto_id" @cannot('direcao') disabled @endcannot>
            @foreach($pilotos as $piloto)
                <option {{ old('piloto_id', (string) $movimento->piloto_id) == $piloto->id ? 'selected' : '' }} value="{{$piloto->id}}"> {{ __("$piloto->num_socio - $piloto->nome_informal") }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="hora_descolagem" class="col-md-4 col-form-label text-md-right">Hora Descolagem</label>

    <div class="col-md-6">
        <input type="time" class="form-control @error('hora_descolagem') is-invalid @enderror" name="hora_descolagem"
               value="{{ old('hora_descolagem', date('H:i',strtotime($movimento->hora_descolagem))) }}">

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
               value="{{ old('hora_aterragem', date('H:i',strtotime($movimento->hora_aterragem))) }}">
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
               value="{{ old('num_diario', (string) $movimento->num_diario) }}">

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
               value="{{ old('num_servico', (string) $movimento->num_servico) }}">

        @error('num_servico')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="natureza" class="col-md-4 col-form-label text-md-right">Natureza </label>

    <div class="col-md-6">
        <select class="form-control" name="natureza" onchange="mostrar(value)">
            <option value="T"
                    {{ old('natureza', (string) $movimento->natureza) == 'T' ? 'selected' : '' }} onclick="mostrar(1);">
                Treino
            </option>

            <option value="I"
                    {{ old('natureza', (string) $movimento->natureza) == 'I' ? 'selected' : '' }} onclick="mostrar(2);">
                Instrução
            </option>

            <option value="E"
                    {{ old('natureza', (string) $movimento->natureza) == 'E' ? 'selected' : '' }} onclick="mostrar(3);">
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
                    <option {{ old('instrutor_id', (string) $movimento->instrutor_id) == $instrutor->id ? 'selected' : '' }} value="{{ $instrutor->id}}"> {{$instrutor->id.'-'.$instrutor->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="tipo_instrucao" class="col-md-4 col-form-label text-md-right"> Tipo Instrucao </label>

        <div class="col-md-6">
            <input type="radio" name="tipo_instrucao"
                   value="D" {{ old('tipo_instrucao', (string) $movimento->tipo_instrucao) == 'D' ? 'checked' : '' }}>Duplo
            Comando <br>

            <input type="radio" name="tipo_instrucao"
                   value="S" {{ old('tipo_instrucao', (string) $movimento->tipo_instrucao) == 'S' ? 'checked' : '' }}>
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
                <option {{ old('aerodromo_partida', (string) $movimento->aerodromo_partida) == $aerodromo->code ? 'selected' : '' }} value="{{ $aerodromo->code}}">{{ __("$aerodromo->code - $aerodromo->nome") }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="aerodromo_chegada" class="col-md-4 col-form-label text-md-right"> Aerodromo Chegada</label>

    <div class="col-md-6">
        <select class="form-control" name="aerodromo_chegada">
            @foreach($aerodromos as $aerodromo)
                <option {{ old('aerodromo_chegada', (string) $movimento->aerodromo_chegada) == $aerodromo->code ? 'selected' : '' }} value="{{ $aerodromo->code}}">{{ __("$aerodromo->code - $aerodromo->nome") }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="num_aterragens" class="col-md-4 col-form-label text-md-right">Número de Aterragens</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_aterragens') is-invalid @enderror" name="num_aterragens"
               value="{{ old('num_aterragens', (string) $movimento->num_aterragens) }}">

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
               value="{{ old('num_descolagens', (string) $movimento->num_descolagens) }}">

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
               value="{{ old('num_pessoas', (string) $movimento->num_pessoas) }}">

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
               value="{{ old('conta_horas_inicio', (string) $movimento->conta_horas_inicio) }}">

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
               value="{{ old('conta_horas_fim', (string) $movimento->conta_horas_fim) }}">

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
            <option value="N" {{ old('modo_pagamento', (string) $movimento->modo_pagamento) == 'N' ? 'selected': '' }}>
                Numerário
            </option>

            <option value="M" {{ old('modo_pagamento', (string) $movimento->modo_pagamento) == 'M' ? 'selected': '' }}>
                Multibanco
            </option>

            <option value="T" {{ old('modo_pagamento', (string) $movimento->modo_pagamento) == 'T' ? 'selected': '' }}>
                Transferência
            </option>

            <option value="P" {{ old('modo_pagamento', (string) $movimento->modo_pagamento) == 'P' ? 'selected': '' }}>
                Pacote de horas
            </option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="num_recibo" class="col-md-4 col-form-label text-md-right"> Número de Recibo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_recibo') is-invalid @enderror" name="num_recibo"
               value="{{ old('num_recibo', (string) $movimento->num_recibo) }}">

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
{{ old('observacoes', (string) $movimento->observacoes) }}
        @error('observacoes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </textarea>
    </div>
</div>
@foreach (['danger', 'warning'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div>
            <label for="resolver" class="col-md-4 col-form-label text-md-right">Guardar com conflitos</label>
            <input type="checkbox" id="resolve" class="form-control-input" name="resolver" onclick="mostrarC()">
        </div>
    @endif
@endforeach
<div id="conflito" style="display:none;">
    <div class="form-group row">
        <label for="justificacao_conflito" class="col-md-4 col-form-label text-md-right">Justificacao conflito</label>
        <div class="col-md-6">
        <textarea rows="3" class="form-control @error('justificacao_conflito') is-invalid @enderror"
                  name="justificacao_conflito">
            {{ old('justificacao_conflito', (string) $movimento->justificacao_conflito) }}
        </textarea>
            @error('justificacao_conflito')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>
</div>
