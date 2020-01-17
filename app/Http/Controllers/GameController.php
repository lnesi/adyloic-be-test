<?php

namespace App\Http\Controllers;

use \App\Team;
use \App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class GameController extends ApiController
{
    protected $modelClass=\App\Game::class;
    public function make(Request $request)
    {
        $this->validate($request, ['home_team_id' => 'required:numeric','visit_team_id:numeric' => 'required']);
        $home_team=Team::find($request->get('home_team_id'));
        if (!$home_team) {
            return $this->error(404, 'Home Team Not found');
        }
        $visit_team=Team::find($request->get('visit_team_id'));
        if (!$visit_team) {
            return $this->error(404, 'Visit Team Not found');
        }
        //dd($request->all());
        $game=new Game($request->all());
        $game->save();
        $game->refresh();
        $game=Game::find($game->id);
        return $game;
    }

    public function updateScore($id, Request $request)
    {
        $this->validate($request, ['home_score' => 'required:numeric','visit_score' => 'required:numeric']);
        $game=Game::find($id);
        if ($game) {
            $game->home_score=$request->get('home_score');
            $game->visit_score=$request->get('visit_score');
            $game->save();
            $game->refresh();
            return $game;
        } else {
            return $this->error(404, 'Game Not found');
        }
    }

    protected function error($status, $message)
    {
        return response()->json(['error' => $status,'message'=>$message], $status);
    }
}
