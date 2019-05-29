@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('MovimentoController@update', ['movimento'=>$movimento->id]) }}"
                              method="POST">
                            @method('PUT')
                            @csrf

                            @include('movimentos.partials.add-edit')

                            <div class="form-group row">
                                <label for="tempo_voo" class="col-md-4 col-form-label text-md-right">Tempo do
                                    Voo</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('tempo_voo') is-invalid @enderror"
                                           name="tempo_voo" readonly
                                           value="{{ old('tempo_voo', (string) $movimento->tempo_voo) }}">

                                    @error('tempo_voo')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="preco_voo" class="col-md-4 col-form-label text-md-right">Preço do
                                    Voo</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('preco_voo') is-invalid @enderror"
                                           name="preco_voo" readonly
                                           value="{{ old('preco_voo', (string) $movimento->preco_voo) }}">

                                    @error('preco_voo')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a type="submit" href="{{action('MovimentoController@index')}}"
                                       class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection