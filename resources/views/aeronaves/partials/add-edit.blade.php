<div class="form-group row">
    <label for="matricula" class="col-md-4 col-form-label text-md-right">Matricula</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{ old('matricula', (string) $aeronave->matricula) }}" autofocus>

        @error('matricula')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="marca" class="col-md-4 col-form-label text-md-right">Marca</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{ old('marca', (string) $aeronave->marca) }}">

        @error('marca')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="modelo" class="col-md-4 col-form-label text-md-right">Modelo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo', (string) $aeronave->modelo) }}">

        @error('marca')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="num_lugares" class="col-md-4 col-form-label text-md-right">Número de Lugares</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('num_lugares') is-invalid @enderror" name="num_lugares" value="{{ old('num_lugares', (string) $aeronave->num_lugares) }}">

        @error('num_lugares')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="conta_horas" class="col-md-4 col-form-label text-md-right">Horas de Voo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('conta_horas') is-invalid @enderror" name="conta_horas" value="{{ old('conta_horas', (string) $aeronave->conta_horas) }}">

        @error('conta_horas')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="preco_hora" class="col-md-4 col-form-label text-md-right">Preço por Hora</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('preco_hora') is-invalid @enderror" name="preco_hora" value="{{ old('preco_hora', (string) $aeronave->preco_hora) }}">

        @error('preco_hora')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
