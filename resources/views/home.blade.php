@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2>{{ __("Bem Vindo") }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-auto">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <img class="img rounded mx-auto d-block border border-secondary"
                     src="{{ asset("storage/homepage.jpg") }}">
            </div>
        </div>
    </div>
@endsection
