@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <h2>{{ $title }}</h2>
    </div>

    @if (count($socios))
        @include('socios.partials.filtros')
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @can('direcao')
                        <a class="btn btn-primary mb-4" href="{{ action('UserController@create') }}">Adicionar Sócio</a>
                    @endcan
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
                                                <img class="img rounded mx-auto d-block border border-secondary" width="50" src="{{ asset("storage/fotos/$socio->foto_url") }}">
                                            @else
                                                <img class="img rounded mx-auto d-block border border-secondary" width="50" src="{{ asset("storage/avatar_placeholder.png") }}">
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
                                            @if ($socio->direcao == 1)
                                                Sim
                                            @else
                                                Não
                                            @endif
                                        </td>
                                        @can('direcao')
                                            <td>
                                                <div class="row justify-content-center">
                                                    <a class="btn btn-xs btn-primary mr-1" href="{{ action('UserController@edit', ['socio' => $socio->id]) }}">Editar</a>
                                                    <form action="{{ action('UserController@destroy', ['socio' => $socio->id]) }}" method="POST" role="form" class="inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-xs btn-danger  mr-1">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {{ $socios->appends($_GET)->links() }}
                        </div>
                    @else
                        <h2>Não foram encontrados sócios</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection