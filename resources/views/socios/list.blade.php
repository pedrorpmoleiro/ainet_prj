@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <a class="btn btn-primary mb-4" href="{{ action('UserController@create') }}">Adicionar Socio</a>

                        @if (count($socios))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Número de Sócio</th>
                                    <th>Nome</th>
                                    <th>Género</th>
                                    <th>Data de Nascimento</th>
                                    <th>Email</th>
                                    <th>NIF</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($socios as $socio)
                                <tr>
                                    <td>{{ $socio->num_socio }}</td>
                                    <td>{{ $socio->nome_informal }}</td>
                                    <td>{{ $socio->sexo }}</td>
                                    <td>{{ $socio->data_nascimento }}</td>
                                    <td>{{ $socio->email }}</td>
                                    <td>{{ $socio->nif }}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a class="btn btn-xs btn-primary mr-1" href="{{ action('UserController@edit', ['socio' => $socio->id]) }}">Editar</a>
                                            <form action="{{ action('UserController@destroy', ['socio' => $socio->id]) }}" method="POST" role="form" class="inline">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger  mr-1">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        {{ $socios->links() }}
                    </div>
                    @else
                        <h2>Não foram encontradas aeronaves</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection