<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nome Completo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', (string) $socio->name) }}" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

    <div class="col-md-6">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', (string) $socio->email) }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<input type="hidden" name="num_socio" value="{{ $socio->num_socio }}">

<div class="form-group row">
    <label for="nome_informal" class="col-md-4 col-form-label text-md-right">Nome Informal</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('nome_informal') is-invalid @enderror" name="nome_informal" value="{{ old('nome_informal', (string) $socio->nome_informal) }}">

        @error('nome_informal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento', (string) $socio->data_nascimento) }}">

        @error('data_nascimento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="nif" class="col-md-4 col-form-label text-md-right">NIF</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif', (string) $socio->nif) }}">

        @error('nif')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="telefone" class="col-md-4 col-form-label text-md-right">Telefone</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone', (string) $socio->telefone) }}">

        @error('telefone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="endereco" class="col-md-4 col-form-label text-md-right">Endereço</label>

    <div class="col-md-6">
        <textarea name="endereco" class="form-control @error('endereco') is-invalid @enderror" >{{ old('endereco', (string) $socio->endereco) }}</textarea>

        @error('endereco')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- TIPO SOCIO RADIO -->
<div class="form-group row">
    <label for="tipo_socio" class="col-md-4 col-form-label text-md-right">Tipo de Sócio</label>

    <div class="col-md-6">
        @if(Auth::user()->direcao)
            <input type="radio" name="tipo_socio" value="P" {{ old('tipo_socio', (string) $socio->tipo_socio) == 'P' ? 'checked' : '' }}>Piloto<br>

            <input type="radio" name="tipo_socio" value="NP" {{ old('tipo_socio', (string) $socio->tipo_socio) == 'NP' ? 'checked' : '' }}>Não Piloto<br>

            <input type="radio" name="tipo_socio" value="A" {{ old('tipo_socio', (string) $socio->tipo_socio) == 'A' ? 'checked' : '' }}>Aeromodelista
        @else
            @if ($socio->tipo_socio == 'P')
                <p>Piloto</p>
            @elseif ($socio->tipo_socio == 'NP')
                <p>Não Piloto</p>
            @else
                <p>Aeromodelista</p>
            @endif
        @endif

    </div>
</div>

<div class="form-group row">
    <label for="file_foto" class="col-md-4 col-form-label text-md-right">Foto de Perfil</label>

    <div class="col-md-6">
        <input id="file_foto" type="file" class="form-control-file" name="file_foto" accept="image/*">
    </div>
</div>