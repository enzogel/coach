@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">CODE DE LA PARTIE : <b>{{ Session::get('code_id')}}</b></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Rejoint à</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <th scope="row">{{ $player->user->id }}</th>
                                <td>{{ $player->user->name }}</td>
                                <td>{{ $player->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($players) > 1)
                    <a href="{{ route('game') }}" class="btn btn-secondary btn-block">Lancer la partie</a>
                    @else
                    <button disabled class="btn btn-secondary btn-block">Il faut être minimum 2 pour commencer</button>
                    @endif
                    <button onclick="window.location.reload()" class="btn btn-outline-secondary btn-block">Recharger la page</button>
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection