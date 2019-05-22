@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="mr-auto">
                                    <h4>Pilotos Autorizados</h4>

                                    <select class="rounded" size="20" multiple>
                                        @foreach($pilotosAeronave as $piloto)
                                            <option class="m-1">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="ml-4">

                                </div>

                                <div class="ml-4">
                                    <h4>Pilotos Não Autorizados</h4>

                                    <select class="rounded" size="20" multiple>
                                        @foreach($pilotos as $piloto)
                                            <option class="m-1">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection