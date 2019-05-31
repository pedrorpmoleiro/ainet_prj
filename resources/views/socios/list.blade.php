@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h2>{{ $title }}</h2>
        </div>


        <div class="row justify-content-center">
            @if (count($socios))
                @include('socios.partials.filtros')
            @endif
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-body">
                        @can('direcao')
                            <div class="row ml-1">
                                <a class="btn btn-sm btn-primary mb-4 mr-1"
                                   href="{{ action('UserController@create') }}">Adicionar Sócio</a>
                                @if (count($socios))
                                    <form method="POST" action="{{ action('UserController@resetQuotas') }}"
                                          class="inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning mb-4 mr-1">
                                            Reset de Quotas
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ action('UserController@desativarSemQuotas') }}"
                                          class="inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark mb-4 mr-1">
                                            Desativar sócios com quotas não pagas
                                        </button>
                                    </form>
                                @endif
                            </div>
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
                                                <img class="img rounded mx-auto d-block border border-secondary"
                                                     width="50" src="{{ asset("storage/fotos/$socio->foto_url") }}">
                                            @else
                                                <img class="img rounded mx-auto d-block border border-secondary"
                                                     width="50" src="{{ asset("storage/avatar_placeholder.png") }}">
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
                                                    <a class="btn btn-sm btn-primary mr-1"
                                                       href="{{ action('UserController@edit', ['socio' => $socio->id]) }}">Editar</a>
                                                    <form action="{{ action('UserController@setQuota', ['socio' => $socio->id]) }}"
                                                          method="POST" class="inline">
                                                        @method('patch')
                                                        @csrf
                                                        @if ($socio->quota_paga)
                                                            <input type="hidden" name="quota_paga" value="0">
                                                            <button type="submit" class="btn btn-sm btn-warning mr-1">
                                                                Quota Não Paga
                                                            </button>
                                                        @else
                                                            <input type="hidden" name="quota_paga" value="1">
                                                            <button type="submit" class="btn btn-sm btn-warning mr-1">
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
                                                            <button type="submit" class="btn btn-sm btn-secondary mr-1">
                                                                Desativar
                                                            </button>
                                                        @else
                                                            <input type="hidden" name="ativo" value="1">
                                                            <button type="submit" class="btn btn-sm btn-success mr-1">
                                                                Ativar
                                                            </button>
                                                        @endif
                                                    </form>
                                                    <form action="{{ action('UserController@destroy', ['socio' => $socio->id]) }}"
                                                          method="POST" role="form" class="inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger  mr-1">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                {{ $socios->appends($filters)->links() }}
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
