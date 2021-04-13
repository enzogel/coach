@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">CODE DE LA PARTIE : <b>{{ Session::get('code_id')}}</b></div>
                <div class="card-body">
                   
                    @if($win !== 0)
                    <div class="alert alert-success" role="alert">
                        Gagnant : {{ $win }}
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($roundGames))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tour #</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Score</th>
                                <th scope="col">Joué à</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roundGames as $roundGame)
                            <tr>
                                <th scope="row">{{ $roundGame->round }}</th>
                                <td>{{ $roundGame->user->name }}</td>
                                <td>{{ $roundGame->score }}</td>
                                <td>{{ $roundGame->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @if($block == 1)
                    <button disabled class="btn btn-success btn-block">Jouer</a>
                    @else
                    <a href="{{ route('playOneTime') }}" class="btn btn-success btn-block">Jouer</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    // var time = new Date().getTime();
    // $(document.body).bind("mousemove keypress", function(e) {

    //     time = new Date().getTime();
    //     console.log(time)
    // });

    // function refresh() {
    //     if (new Date().getTime() - time >= 7000)
    //         window.location.reload(true);
    //     else
    //         setTimeout(refresh, 1000);
    // }

    // setTimeout(refresh, 7000);
</script>
@endsection