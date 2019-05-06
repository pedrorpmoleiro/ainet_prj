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

<!-- DIRECAO // ESCONDIDO DO UTILIZADOR NORMAL -->
<!-- TIPO SOCIO RADIO -->
<div class="form-group row">
    <label for="tipo_socio" class="col-md-4 col-form-label text-md-right">Direção</label>

    <div class="col-md-6">
        <input type="radio" name="tipo_socio" value="P" {{ old('tipo_socio', strval($socio->tipo_socio)) == 'P' ? 'checked' : '' }}>Piloto<br>
        
        <input type="radio" name="tipo_socio" value="NP" {{ old('tipo_socio', strval($socio->tipo_socio)) == 'NP' ? 'checked' : '' }}>Não Piloto<br>
        
        <input type="radio" name="tipo_socio" value="A" {{ old('tipo_socio', strval($socio->tipo_socio)) == 'A' ? 'checked' : '' }}>Aeromodelista

        @error('direcao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- QUOTA PAGA RADIO -->
<div class="form-group row">
    <label for="quota_paga" class="col-md-4 col-form-label text-md-right">Quota Paga</label>

    <div class="col-md-6">
        <input type="radio" name="quota_paga" value="1" {{ old('quota_paga', strval($socio->quota_paga)) == '1' ? 'checked' : '' }}>Sim<br>
        
        <input type="radio" name="quota_paga" value="0" {{ old('quota_paga', strval($socio->quota_paga)) == '0' ? 'checked' : '' }}>Não
        
        @error('quota_paga')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- DIRECAO RADIO -->
<div class="form-group row">
    <label for="direcao" class="col-md-4 col-form-label text-md-right">Direção</label>

    <div class="col-md-6">
        <input type="radio" name="direcao" value="1" {{ old('direcao', strval($socio->direcao)) == '1' ? 'checked' : '' }}>Sim<br>
        
        <input type="radio" name="direcao" value="0" {{ old('direcao', strval($socio->direcao)) == '0' ? 'checked' : '' }}>Não
        
        @error('direcao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- INSTRUTOR RADIO -->
<div class="form-group row">
    <label for="instrutor" class="col-md-4 col-form-label text-md-right">Instrutor</label>

    <div class="col-md-6">
        <input type="radio" name="instrutor" value="1" {{ old('instrutor', strval($socio->instrutor)) == '1' ? 'checked' : '' }}>Sim<br>
        
        <input type="radio" name="instrutor" value="0" {{ old('instrutor', strval($socio->instrutor)) == '0' ? 'checked' : '' }}>Não
        
        @error('instrutor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- ALUNO RADIO -->
<div class="form-group row">
    <label for="aluno" class="col-md-4 col-form-label text-md-right">Aluno</label>

    <div class="col-md-6">
        <input type="radio" name="aluno" value="1" {{ old('aluno', strval($socio->aluno)) == '1' ? 'checked' : '' }}>Sim<br>
        
        <input type="radio" name="aluno" value="0" {{ old('aluno', strval($socio->aluno)) == '0' ? 'checked' : '' }}>Não
        
        @error('aluno')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- ATIVO -->
<div class="form-group row">
    <label for="ativo" class="col-md-4 col-form-label text-md-right">Ativo</label>

    <div class="col-md-6">
        <input type="radio" name="ativo" value="1" {{ old('ativo', strval($socio->ativo)) == '1' ? 'checked' : '' }}>Sim<br>
        
        <input type="radio" name="ativo" value="0" {{ old('ativo', strval($socio->ativo)) == '0' ? 'checked' : '' }}>Não
        
        @error('ativo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>