@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-22">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="mb-2">
                                <h2>{{ __("Movimentos Pendentes") }}</h2>
                            </div>

                            @if (count($movimentos))
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Aeronave</th>
                                            <th>Data</th>
                                            <th>Hora Descolagem</th>
                                            <th>Hora Aterragem</th>
                                            <th>Tempo de Voo</th>
                                            <th>Natureza</th>
                                            <th>Nome do Piloto</th>
                                            <th>Aeródromo Partida</th>
                                            <th>Aeródromo Chegada</th>
                                            <th>Conta-horas Inicial</th>
                                            <th>Conta-horas Final</th>
                                            @can('pilotoDirecao')
                                                <th>Ações</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($movimentos as $movimento)
                                            <tr>
                                                <td>{{ $movimento->id }}</td>
                                                <td>{{ $movimento->aeronave }}</td>
                                                <td>{{ $movimento->data }}</td>
                                                <td>{{ $movimento->hora_descolagem }}</td>
                                                <td>{{ $movimento->hora_aterragem }}</td>
                                                <td>{{ $movimento->tempo_voo }}</td>
                                                <td>{{ $movimento::toString($movimento->natureza) }}</td>
                                                <td>{{ $movimento->piloto->nome_informal }}</td>
                                                <td>{{ $movimento->aerodromo_partida }}</td>
                                                <td>{{ $movimento->aerodromo_chegada }}</td>
                                                <td>{{ $movimento->conta_horas_inicio }}</td>
                                                <td>{{ $movimento->conta_horas_fim }}</td>
                                                @if(Auth::user()->direcao || Auth::user()->id==$movimento->piloto_id)
                                                    <td>
                                                        <div class="row justify-content-center">
                                                            @if ($movimento->confirmado == 0)
                                                                <a class="btn btn-sm btn-primary mr-1"
                                                                href="{{ action('MovimentoController@edit', ['movimento' => $movimento->id]) }}">Editar</a>
                                                                @can('direcao')
                                                                    <form action="{{ action('MovimentoController@update', ['movimento'=>$movimento->id]) }}"
                                                                        method="POST">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-warning  mr-1"
                                                                                name="confirmar">
                                                                            Confirmar
                                                                        </button>
                                                                    </form>
                                                                @endcan
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row justify-content-center">
                                    {{ $movimentos->links() }}
                                </div>
                            @else
                                <h2>Não foram encontrados movimentos com pendentes</h2>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <h2>{{ __("Socios Pendentes") }}</h2>
                        </div>
                        @if (count($socios))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Número de Sócio</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Nº de telefone</th>
                                        <th>Nº de Licença</th>
                                        <th>Nº de Certificado</th>
                                        <th>Direção</th>
                                        @can('direcao')
                                            <th>Ações</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($socios as $socio)
                                        <tr>
                                            <td>
                                                @if ($socio->foto_url)
                                                    <img class="img rounded mx-auto d-block border border-secondary"
                                                        width="50"
                                                        src="{{ asset("storage/fotos/$socio->foto_url") }}">
                                                @else
                                                    <img class="img rounded mx-auto d-block border border-secondary"
                                                        width="50"
                                                        src="{{ asset("storage/avatar_placeholder.png") }}">
                                                @endif
                                            </td>
                                            <td>{{ $socio->num_socio }}</td>
                                            <td>{{ $socio->nome_informal }}</td>
                                            <td>{{ $socio->email }}</td>
                                            <td>{{ $socio->telefone }}</td>
                                            <td>
                                                @if ($socio->num_licenca)
                                                    {{ $socio->num_licenca }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($socio->num_certificado)
                                                    {{ $socio->num_certificado }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td>
                                                @if ($socio->direcao == 1)
                                                    Sim
                                                @else
                                                    Não
                                                @endif
                                            </td>
                                            @can('direcao')
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <a class="btn btn-sm btn-primary mr-1"
                                                        href="{{ action('UserController@edit', ['socio' => $socio->id]) }}">Editar</a>
                                                        <form action="{{ action('UserController@setQuota', ['socio' => $socio->id]) }}"
                                                            method="POST" class="inline">
                                                            @method('patch')
                                                            @csrf
                                                            @if ($socio->quota_paga)
                                                                <input type="hidden" name="quota_paga"
                                                                    value="0">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-warning mr-1">
                                                                    Quota Não Paga
                                                                </button>
                                                            @else
                                                                <input type="hidden" name="quota_paga"
                                                                    value="1">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-warning mr-1">
                                                                    Pagar Quota
                                                                </button>
                                                            @endif
                                                        </form>
                                                        <form action="{{ action('UserController@ativarSocio', ['socio' => $socio->id]) }}"
                                                            method="POST" class="inline">
                                                            @method('patch')
                                                            @csrf
                                                            @if ($socio->ativo)
                                                                <input type="hidden" name="ativo" value="0">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-warning mr-1">
                                                                    Desativar
                                                                </button>
                                                            @else
                                                                <input type="hidden" name="ativo" value="1">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-warning mr-1">
                                                                    Ativar
                                                                </button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                {{ $socios->links() }}
                            </div>
                        @else
                            <h2>Não foram encontrados sócios com pendentes</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
