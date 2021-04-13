@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3 class="text-center mb-3">{{ __('Lancer une partie') }}</h3>

                    <form action="{{ route('createGame') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="code_id" class="col-sm-3 col-form-label">Code de la partie</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="code_id" name="code_id" readonly value="{{ $codeGame }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description rapide</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Partie 04/05/2021" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <a href="{{ url('/') }}" class="btn btn-outline-danger btn-block">Annuler</a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-block">Créer</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection