@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <h2>{{ $title }}</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ action('UserController@store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('socios.partials.add-edit')

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection