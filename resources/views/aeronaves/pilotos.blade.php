@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2>{{ $title }}</h2>
        </div>

        <script type="text/javascript">
            function changeAction() {
                var e = document.getElementById('pilotosAuthorized');
                var aut = e.options[e.selectedIndex].value;

                var e = document.getElementById('pilotosNotAuthorized');
                var nAut = e.options[e.selectedIndex].value;

                document.getElementById('add_piloto_form').action = "{{ action('AeronaveController@pilotos', ['aeronave' => $aeronave->matricula]) }}".concat("/").concat(nAut);
                document.getElementById('remove_piloto_form').action = "{{ action('AeronaveController@pilotos', ['aeronave' => $aeronave->matricula]) }}".concat("/").concat(aut);
            }
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
                                        @foreach($pilotosAeronave as $piloto)
                                            <option class="m-1" value="{{ $piloto->id }}">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="ml-2 col">
                                    <form method="post" name="add_piloto_form" id="add_piloto_form" onsubmit="changeAction()">
                                        @csrf
                                        <button type="submit" class="btn bg-transparent"><img class="img rounded bg-transparent" width="30" src="{{ asset("storage/arrow_left.png") }}"></button>
                                    </form>
                                    <form method="post" name="remove_piloto_form" id="remove_piloto_form" onsubmit="changeAction()">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn bg-transparent"><img class="img rounded bg-transparent" width="30" src="{{ asset("storage/arrow_right.png") }}"></button>
                                    </form>
                                </div>

                                <div class="ml-2">
                                    <h4>Pilotos Não Autorizados</h4>

                                    <select id="pilotosNotAuthorized" class="rounded" size="20">
                                        @foreach($pilotos as $piloto)
                                            <option class="m-1" value="{{ $piloto->id }}">{{ __("$piloto->id - $piloto->nome_informal") }}</option>
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