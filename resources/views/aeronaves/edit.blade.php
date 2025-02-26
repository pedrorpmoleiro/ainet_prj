@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('AeronaveController@update', ['aeronave' => $aeronave->matricula]) }}"
                              method="post">
                            @method('PUT')
                            @csrf

                            @include('aeronaves.partials.add-edit')

                            @can('direcao')
                                <div class="form-group row mb-2">
                                    <div class="col-md-8 offset-md-4">
                                        <a class="btn btn-link"
                                           href="{{ action('AeronaveController@pilotos', ['aeronave' => $aeronave->matricula]) }}">
                                            Ver Pilotos
                                        </a>
                                    </div>
                                </div>
                            @endcan

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary">Submeter</button>
                                    <a role="button" href="{{action('AeronaveController@index')}}"
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