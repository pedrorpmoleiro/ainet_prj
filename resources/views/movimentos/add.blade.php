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
                        <form action="{{ action('MovimentoController@store') }}" method="post">
                            @csrf

                            @include('movimentos.partials.add-edit')

                            <input type="hidden" name="tempo_voo" value="124">
                            <input type="hidden" name="preco_voo" value="123">

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submeter</button>
                                    <a role="button" href="{{action('MovimentoController@index')}}"
                                       class="btn btn-sm btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection