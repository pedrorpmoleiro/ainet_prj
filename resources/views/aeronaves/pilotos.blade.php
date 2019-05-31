@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2>{{ $title }}</h2>
        </div>

        <script type="text/javascript">
            @if (count($pilotos))
                function changeActionAdd() {
                    var e = document.getElementById('pilotosNotAuthorized');
                    var nAut = e.options[e.selectedIndex].value;

                    document.getElementById('add_piloto_form').action = "{{ action('AeronaveController@pilotos', ['aeronave' => $aeronave->matricula]) }}".concat("/").concat(nAut);
                }
            @endif
            @if (count($pilotosAeronave))
                function changeActionRemove() {
                    var e = document.getElementById('pilotosAuthorized');
                    var aut = e.options[e.selectedIndex].value;

                    document.getElementById('remove_piloto_form').action = "{{ action('AeronaveController@pilotos', ['aeronave' => $aeronave->matricula]) }}".concat("/").concat(aut);
                }
            @endif
        </script>

        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="mr-auto">
                                    <h4>Pilotos Autorizados</h4>

                                    <select id="pilotosAuthorized" class="rounded" size="20">
                                        @if (count($pilotosAeronave))
                                            @foreach($pilotosAeronave as $piloto)
                                                <option class="m-1"
                                                        value="{{ $piloto->id }}">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
                                            @endforeach
                                        @else
                                            <option class="m-1" value="-1"
                                                    disabled>{{ __('-- Não existem pilotos --') }}</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="ml-2 col">
                                    @if (count($pilotos))
                                        <form method="post" name="add_piloto_form" id="add_piloto_form">
                                            @csrf
                                            <button type="submit" class="btn bg-transparent"
                                                    onclick="changeActionAdd()">
                                                <img class="img rounded bg-transparent" width="30"
                                                     src="{{ asset("storage/arrow_left.png") }}">
                                            </button>
                                        </form>
                                    @endif
                                    @if (count($pilotosAeronave))
                                        <form method="post" name="remove_piloto_form" id="remove_piloto_form">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn bg-transparent"
                                                    onclick="changeActionRemove()">
                                                <img class="img rounded bg-transparent" width="30"
                                                     src="{{ asset("storage/arrow_right.png") }}">
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <div class="ml-2">
                                    <h4>Pilotos Não Autorizados</h4>

                                    <select id="pilotosNotAuthorized" class="rounded" size="20">
                                        @if (count($pilotos))
                                            @foreach($pilotos as $piloto)
                                                <option class="m-1"
                                                        value="{{ $piloto->id }}">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
                                            @endforeach
                                        @else
                                            <option class="m-1" value="-1"
                                                    disabled>{{ __('-- Não existem pilotos --') }}</option>
                                        @endif
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