<?php

namespace App\Http\Controllers;

use App\Game;
use App\Gameround;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function launchGame()
    {
        if (Session::get('code_id')) {
            return view('pages/start_game');
        } else {
            $codeGame = strtoupper(Str::random(10));
            return view('pages/launch_game', compact('codeGame'));
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function joinGame()
    {
        if (Session::get('code_id')) {
            return view('pages/start_game');
        } else {
            return view('pages/join_game');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createGame(Request $request)
    {
        $game = new Game();
        $game->code_id = $request->input('code_id');
        $game->description = $request->input('description');
        $game->save();
        Session::put('code_id', $request->input('code_id'));
        $this->joinPlayer($game->id, $game->code_id);
        return view('pages/start_game');
    }

    public function codeGame(Request $request)
    {
        $value = Game::where('code_id', $request->input('code_id'))->first();
        if (isset($value)) {
            Session::put('code_id', $request->input('code_id'));
            $this->joinPlayer($value->id, $value->code_id);
            return view('pages/start_game');
        } else {
            return redirect()->back()->with('status', 'code partie inconnu');
        }
    }
    public function oublie()
    {
        $value = Player::where('user_id', Auth::user()->id)->first();
        $value->delete();

        Session::forget('code_id');
        return view('welcome')->with('status', 'storage clear');
    }

    static function joinPlayer($game_id, $game_code_id)
    {
        $player = new Player();
        $player->user_id = Auth::user()->id;
        $player->game_id = $game_id;
        $player->game_code_id = $game_code_id;
        $player->save();
    }

    public function readyGame()
    {
        $players = Player::where('game_code_id', Session::get('code_id'))->with('user')->get();
        return view('pages/player_game', compact('players'));
    }
    public function game()
    {
        $win = 0;
        $block = 0;
        return view('pages/game', compact('win','block'));
    }
    public function playOneTime()
    {
        
        $user_id = Auth::user()->id;
        $code_id = Session::get('code_id');


        $lastPlay = Gameround::where('game_code_id', $code_id)->orderBy('created_at', 'desc')->first();
        // dump($lastPlay);die;
        if (isset($lastPlay)) {
            
            if ($lastPlay->user_id == $user_id) {
                $win = 0;
                $block = 0;
                $roundGames = Gameround::where('game_code_id', $code_id)->orderBy('created_at', 'desc')->get();
                return view('pages/game', compact('roundGames', 'win','block'))->with('status', 'storage clear');
            } else {
                $gameround = new Gameround();
                $gameround->user_id = $user_id;
                $gameround->game_code_id = $code_id;
                $gameround->score = rand(1, 6);
                $gameroundTable = Gameround::where([['game_code_id', $code_id], ['user_id', $user_id]])->orderBy('created_at', 'desc')->first();
                if (isset($gameroundTable)) {
                    $gameround->round = $gameroundTable->round + 1;
                } else {
                    $gameround->round = 1;
                }
    
                $gameround->save();
                $scoreAnalyse = $this->checkScore($user_id, $code_id);
                if ($scoreAnalyse > 60) {
                    $win = Auth::user()->name;
                } else {
                    $win = 0;
                }
                $block = 0;
            }
        } else {
            $gameround = new Gameround();
            $gameround->user_id = $user_id;
            $gameround->game_code_id = $code_id;
            $gameround->score = rand(1, 6);
            $gameroundTable = Gameround::where([['game_code_id', $code_id], ['user_id', $user_id]])->orderBy('created_at', 'desc')->first();
            if (isset($gameroundTable)) {
                $gameround->round = $gameroundTable->round + 1;
            } else {
                $gameround->round = 1;
            }

            $gameround->save();
            $scoreAnalyse = $this->checkScore($user_id, $code_id);
            if ($scoreAnalyse > 60) {
                $win = Auth::user()->name;
            } else {
                $win = 0;
            }
            $block = 0;
        }
        $roundGames = Gameround::where('game_code_id', $code_id)->orderBy('created_at', 'desc')->get();
        $block = 0;
        return view('pages/game', compact('roundGames', 'win','block'));
    }
    static function checkScore($user_id, $code_id)
    {
        $scoreAnalyse = Gameround::where([['game_code_id', $code_id], ['user_id', $user_id]])->sum('score');
        return $scoreAnalyse;
    }
}
