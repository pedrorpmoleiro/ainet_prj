@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    @can('direcao')
                        <a class="btn btn-primary mb-4" href="{{ action('AeronaveController@create') }}">Adicionar aeronave</a>
                    @endcan
                    @if (count($aeronaves))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de Lugares</th>
                                <th>Horas de Voo</th>
                                <th>Preço por Hora</th>
                                @can('direcao')
                                    <th>Ações</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aeronaves as $aeronave)
                            <tr>
                                <td>{{ $aeronave->matricula }}</td>
                                <td>{{ $aeronave->marca }}</td>
                                <td>{{ $aeronave->modelo }}</td>
                                <td>{{ $aeronave->num_lugares }}</td>
                                <td>{{ $aeronave->conta_horas }}</td>
                                <td>{{ $aeronave->preco_hora }}</td>
                                @can('direcao')
                                    <td>
                                        <div class="row justify-content-center">
                                            <a class="btn btn-xs btn-primary  mr-1" href="{{ action('AeronaveController@edit', ['aeronave' => $aeronave->matricula]) }}">Editar</a>
                                            <form action="{{ action('AeronaveController@destroy', ['aeronave' => $aeronave->matricula]) }}" method="POST" role="form" class="inline">
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-xs btn-danger  mr-1">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h2>Não foram encontradas aeronaves</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection