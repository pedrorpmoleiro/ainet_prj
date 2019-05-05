@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ action('UserController@create') }}">Adicionar Socio</a>
                        
                        @if (count($socios))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($socios as $socio)
                                <tr>
                                    <td>{{ $socio->id }}</td>
                                    <td>{{ $socio->name }}</td>
                                    <td>{{ $socio->email }}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a class="btn btn-xs btn-primary" href="{{ action('UserController@edit', ['socio' => $socio->id]) }}">Editar</a>
                                            <form action="{{ action('UserController@destroy', ['socio' => $socio->id]) }}" method="POST" role="form" class="inline">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
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