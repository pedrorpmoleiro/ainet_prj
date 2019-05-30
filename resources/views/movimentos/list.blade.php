@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h2>{{ $title }}</h2>
        </div>

        @if (count($movimentos))
            @include('movimentos.partials.filtros')
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @can('pilotoDirecao')
                            <a class="btn btn-primary mb-4" href="{{ action('MovimentoController@create') }}">Adicionar
                                Movimento</a>
                        @endcan
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
                                    <th>Nº de Aterragens</th>
                                    <th>Nº de Descolagens</th>
                                    <th>Nº Diário</th>
                                    <th>Nº de Serviço</th>
                                    <th>Conta-horas Inicial</th>
                                    <th>Conta-horas Final</th>
                                    <th>Nº de pessoas a bordo</th>
                                    <th>Tipo de Instrução</th>
                                    <th>Nome do Instrutor</th>
                                    <th>Confirmado</th>
                                    <th>Observações</th>
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
                                        <td>{{ $movimento->num_aterragens }}</td>
                                        <td>{{ $movimento->num_descolagens }}</td>
                                        <td>{{ $movimento->num_diario }}</td>
                                        <td>{{ $movimento->num_servico }}</td>
                                        <td>{{ $movimento->conta_horas_inicio }}</td>
                                        <td>{{ $movimento->conta_horas_fim }}</td>
                                        <td>{{ $movimento->num_pessoas }}</td>
                                        <td>
                                            @if ($movimento->tipo_instrucao)
                                                {{ $movimento->tipo_instrucao }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($movimento->tipo_instrucao)
                                                {{ $movimento->instrutor->nome_informal }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($movimento->confirmado == 1)
                                                Sim
                                            @else
                                                Não
                                            @endif
                                        </td>
                                        <td>{{ $movimento->observacoes }}</td>

                                        @if(Auth::user()->direcao || Auth::user()->id==$movimento->piloto_id)
                                            <td>
                                                <div class="row justify-content-center">
                                                    @if ($movimento->confirmado == 0)
                                                        <a class="btn btn-xs btn-primary mr-1"
                                                           href="{{ action('MovimentoController@edit', ['movimento' => $movimento->id]) }}">Editar</a>
                                                        @can('direcao')
                                                            <form action="{{ action('MovimentoController@update', ['movimento'=>$movimento->id]) }}"method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <button type="submit" class="btn btn-xs btn-warning  mr-1" name="confirmar">
                                                                    Confirmar
                                                                </button>
                                                            </form>
                                                        @endcan
                                                        <form action="{{ action('MovimentoController@destroy', ['movimento' => $movimento->id]) }}"
                                                              method="POST" role="form" class="inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-xs btn-danger  mr-1">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                {{ $movimentos->appends($filters)->links() }}
                            </div>
                        @else
                            <h2>Não foram encontrados movimentos</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
