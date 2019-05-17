@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <a class="btn btn-primary mb-4" href="{{ action('MovimentoController@create') }}">Adicionar Movimento</a>
                    @if (count($movimentos))
                        @include('movimentos.partials.filtros')
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Hora Descolagem</th>
                                    <th>Hora Aterragem</th>
                                    <th>Aeronave</th>
                                    <th>Piloto</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimentos as $movimento)
                                    <tr>
                                        <td>{{ $movimento->id }}</td>
                                        <td>{{ $movimento->data }}</td>
                                        <td>{{ $movimento->hora_descolagem }}</td>
                                        <td>{{ $movimento->hora_aterragem }}</td>
                                        <td>{{ $movimento->aeronave }}</td>
                                        <td>{{ $movimento->piloto_id }}</td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a class="btn btn-xs btn-primary mr-1" href="{{ action('MovimentoController@edit', ['movimento' => $movimento->id]) }}">Editar</a>
                                                <form action="{{ action('MovimentoController@destroy', ['movimento' => $movimento->id]) }}" method="POST" role="form" class="inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger  mr-1">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {{ $movimentos->appends($_GET)->links() }}
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