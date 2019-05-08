@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <form action="{{ action('UserController@patchPassword') }}" method="post">
                        @method('patch')
                        @csrf

                        <div class="form-group row">
                            <label for="passwordNew" class="col-md-4 col-form-label text-md-right">Nova senha</label>

                            <div class="col-md-6">
                                <input id="passwordNew" type="password" class="form-control @error('passwordNew') is-invalid @enderror" name="passwordNew" value="{{ old('passwordNew') }}" required>

                                @error('passwordNew')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwordNewConfirm" class="col-md-4 col-form-label text-md-right">Confirme a nova senha</label>

                            <div class="col-md-6">
                                <input id="passwordNewConfirm" type="password" class="form-control @error('passwordNewConfirm') is-invalid @enderror" name="passwordNewConfirm" value="{{ old('passwordNewConfirm') }}" required>

                                @error('passwordNewConfirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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