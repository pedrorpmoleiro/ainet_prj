<div class="form-group row">
    <label for="aeronave" class="col-md-4 col-form-label text-md-right">Aeronave</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('aeronave') is-invalid @enderror" name="aeronave" value="{{ old('aeronave', strval($movimento->aeronave)) }}" autofocus>

        @error('aeronave')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="data" class="col-md-4 col-form-label text-md-right">Data de voo</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{ old('data', strval($movimento->data)) }}">

        @error('data')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="hora_descolagem" class="col-md-4 col-form-label text-md-right">Horas Descolagem</label>

    <div class="col-md-6">
        <input type="time" class="form-control @error('hora_descolagem') is-invalid @enderror" name="hora_descolagem" value="{{ old('hora_descolagem', strval($movimento->hora_descolagem)) }}">

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
        <input type="time" class="form-control @error('hora_aterragem') is-invalid @enderror" name="hora_aterragem" value="{{ old('hora_aterragem', strval($movimento->hora_aterragem)) }}">
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
        <input type="text" class="form-control @error('num_diario') is-invalid @enderror" name="num_diario" value="{{ old('num_diario', strval($movimento->num_diario)) }}">

        @error('num_diario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_servicio" class="col-md-4 col-form-label text-md-right">Número de Servicio</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_servicio') is-invalid @enderror" name="num_servicio" value="{{ old('num_servicio', strval($movimento->num_servicio)) }}">

        @error('num_servicio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="piloto_id" class="col-md-4 col-form-label text-md-right">Número de Piloto</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('piloto_id') is-invalid @enderror" name="piloto_id" value="{{ old('piloto_id', strval($movimento->piloto_id)) }}">

        @error('piloto_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_certificado_piloto" class="col-md-4 col-form-label text-md-right">Número de Certificado</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_certificado_piloto') is-invalid @enderror" name="num_certificado_piloto" value="{{ old('num_certificado_piloto', strval($movimento->num_certificado_piloto)) }}">

        @error('num_certificado_piloto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label for="validade_certificado_piloto" class="col-md-4 col-form-label text-md-right">Validade certificado piloto</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('validade_certificado_piloto') is-invalid @enderror" name="validade_certificado_piloto" value="{{ old('validade_certificado_piloto', strval($movimento->validade_certificado_piloto)) }}">

        @error('validade_certificado_piloto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="classe_certificado_piloto" class="col-md-4 col-form-label text-md-right">Classe certificado piloto</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('classe_certificado_piloto') is-invalid @enderror" name="classe_certificado_piloto" value="{{ old('classe_certificado_piloto', strval($movimento->classe_certificado_piloto)) }}">

        @error('classe_certificado_piloto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- NATURAEZA  -->
<div class="form-group row">
    <label for="natureza" class="col-md-4 col-form-label text-md-right">Natureza </label>

    <div class="col-md-6">
        <input type="radio" name="natureza" value="T" {{ old('natureza', strval($movimento->natureza)) == 'P' ? 'checked' : '' }}>Treino<br>
        
        <input type="radio" name="natureza" value="I" {{ old('natureza', strval($movimento->natureza)) == 'NP' ? 'checked' : '' }}>Instrução<br>
        
        <input type="radio" name="natureza" value="E" {{ old('natureza', strval($movimento->natureza)) == 'A' ? 'checked' : '' }}>Especial

        @error('direcao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="aerodromo_partida" class="col-md-4 col-form-label text-md-right"> Aerodromo Partida</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('aerodromo_partida') is-invalid @enderror" name="aerodromo_partida" value="{{ old('aerodromo_partida', strval($movimento->aerodromo_partida)) }}">

        @error('aerodromo_partida')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="aerodromo_chegada" class="col-md-4 col-form-label text-md-right"> Aerodromo Partida</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('aerodromo_chegada') is-invalid @enderror" name="aerodromo_chegada" value="{{ old('aerodromo_chegada', strval($movimento->aerodromo_chegada)) }}">

        @error('aerodromo_chegada')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_aterragens" class="col-md-4 col-form-label text-md-right">Número de Aterragens</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_aterragens') is-invalid @enderror" name="num_aterragens" value="{{ old('num_aterragens', strval($movimento->num_aterragens)) }}">

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
        <input type="text" class="form-control @error('num_descolagens') is-invalid @enderror" name="num_descolagens" value="{{ old('num_descolagens', strval($movimento->num_descolagens)) }}">

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
        <input type="text" class="form-control @error('num_pessoas') is-invalid @enderror" name="num_pessoas" value="{{ old('num_pessoas', strval($movimento->num_pessoas)) }}">

        @error('num_pessoas')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="conta_horas_inicio" class="col-md-4 col-form-label text-md-right">Horas incio</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('conta_horas_inicio') is-invalid @enderror" name="conta_horas_inicio" value="{{ old('conta_horas_inicio', strval($movimento->conta_horas_inicio)) }}">

        @error('conta_horas_inicio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="conta_horas_fim" class="col-md-4 col-form-label text-md-right">Horas de fim</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('conta_horas_fim') is-invalid @enderror" name="conta_horas_fim" value="{{ old('conta_horas_fim', strval($movimento->conta_horas_fim)) }}">

        @error('conta_horas_fim')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- MODO PAGAMENTO  -->
<div class="form-group row">
    <label for="modo_pagamento" class="col-md-4 col-form-label text-md-right">Modo Pagamento </label>

    <div class="col-md-6">
        <input type="radio" name="modo_pagamento" value="N" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'P' ? 'checked' : '' }}>Numerário<br>
        
        <input type="radio" name="modo_pagamento" value="M" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'NP' ? 'checked' : '' }}>Multibanco<br>
        
        <input type="radio" name="modo_pagamento" value="T" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'A' ? 'checked' : '' }}>Transferência <br>

        <input type="radio" name="modo_pagamento" value="P" {{ old('modo_pagamento', strval($movimento->modo_pagamento)) == 'A' ? 'checked' : '' }}>Pacote de horas

        @error('modo_pagamento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_recibo" class="col-md-4 col-form-label text-md-right"> Número de Recibo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_recibo') is-invalid @enderror" name="num_recibo" value="{{ old('num_recibo', strval($movimento->num_recibo)) }}">

        @error('num_recibo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- si for DE INSTRUCAO  -->
<div class="form-group row">
    <label for="tipo_instrucao" class="col-md-4 col-form-label text-md-right"> Tipo Instrucao </label>

    <div class="col-md-6">
        <input type="radio" name="tipo_instrucao" value="D" {{ old('tipo_instrucao', strval($movimento->tipo_instrucao)) == 'P' ? 'checked' : '' }}>Duplo Comando <br>
        
        <input type="radio" name="tipo_instrucao" value="S" {{ old('tipo_instrucao', strval($movimento->tipo_instrucao)) == 'NP' ? 'checked' : '' }}> Solo

        @error('tipo_instrucao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="instrutor_id" class="col-md-4 col-form-label text-md-right">Número de Socio</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('instrutor_id') is-invalid @enderror" name="instrutor_id" value="{{ old('instrutor_id', strval($movimento->instrutor_id)) }}">

        @error('instrutor_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="num_licenca_instrutor" class="col-md-4 col-form-label text-md-right"> Tipo Licenca</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_licenca_instrutor') is-invalid @enderror" name="num_licenca_instrutor" value="{{ old('num_licenca_instrutor', strval($movimento->num_licenca_instrutor)) }}">

        @error('num_licenca_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="validade_licenca_instrutor" class="col-md-4 col-form-label text-md-right">Validade certificado instructor</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('validade_licenca_instrutor') is-invalid @enderror" name="validade_licenca_instrutor" value="{{ old('validade_licenca_instrutor', strval($movimento->validade_licenca_instrutor)) }}">

        @error('validade_licenca_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="tipo_licenca_instrutor" class="col-md-4 col-form-label text-md-right"> Tipo Licenca</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('tipo_licenca_instrutor') is-invalid @enderror" name="tipo_licenca_instrutor" value="{{ old('tipo_licenca_instrutor', strval($movimento->tipo_licenca_instrutor)) }}">

        @error('tipo_licenca_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="num_certificado_instrutor" class="col-md-4 col-form-label text-md-right"> Tipo Licenca</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_certificado_instrutor') is-invalid @enderror" name="num_certificado_instrutor" value="{{ old('num_certificado_instrutor', strval($movimento->num_certificado_instrutor)) }}">

        @error('num_certificado_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="validade_certificado_instrutor" class="col-md-4 col-form-label text-md-right">Validade certificado instructor</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('validade_certificado_instrutor') is-invalid @enderror" name="validade_certificado_instrutor" value="{{ old('validade_certificado_instrutor', strval($movimento->validade_certificado_instrutor)) }}">

        @error('validade_certificado_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="classe_certificado_instrutor" class="col-md-4 col-form-label text-md-right"> Tipo Licenca</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('classe_certificado_instrutor') is-invalid @enderror" name="classe_certificado_instrutor" value="{{ old('classe_certificado_instrutor', strval($movimento->classe_certificado_instrutor)) }}">

        @error('classe_certificado_instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>