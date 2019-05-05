<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nome Completo</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', strval($socio->name)) }}" autofocus>

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
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', strval($socio->email)) }}">

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
        <input type="text" class="form-control @error('nome_informal') is-invalid @enderror" name="nome_informal" value="{{ old('nome_informal', strval($socio->nome_informal)) }}">

        @error('nome_informal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- GENERO RADIO -->

<div class="form-group row">
    <label for="sexo" class="col-md-4 col-form-label text-md-right">Género</label>

    <div class="col-md-6">
        <input type="radio" name="sexo" value="M" {{ old('sexo', strval($socio->sexo)) == 'M' ? 'checked' : '' }}>Masculino<br>
        
        <input type="radio" name="sexo" value="F" {{ old('sexo', strval($socio->sexo)) == 'F' ? 'checked' : '' }}>Feminino
        
        @error('sexo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="data_nascimento" class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>

    <div class="col-md-6">
        <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" value="{{ old('data_nascimento', strval($socio->data_nascimento)) }}">

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
        <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif', strval($socio->nif)) }}">

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
        <input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone', strval($socio->telefone)) }}">

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
        <input type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco', strval($socio->endereco)) }}">

        @error('endereco')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- DIRECAO -->
<!-- TIPO SOCIO RADIO -->
<!-- QUOTA PAGA RADIO -->
<!-- DIRECAO RADIO -->
<!-- INSTRUTOR RADIO -->
<!-- ALUNO RADIO -->