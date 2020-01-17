<?php

namespace App\Http\Controllers;

use \App\Team;
use \App\Player;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function make(Request $request)
    {
        $this->validate($request, ['teamid' => 'required:numeric','playerid' => 'required:numeric']);
        $team=Team::find($request->get('teamid'));
        if (!$team) {
            return $this->error(404, 'Team Not found');
        }
        $player=Player::find($request->get('playerid'));
        if (!$player) {
            return $this->error(404, 'Player Not found');
        }
        if ($team->players()->get()->count()>=8) {
            return $this->error(422, 'Team is full only 8 playes allow');
        }
        $player->team_id=$team->id;
        $player->save();
        $player->refresh();
        return $player;
    }
    protected function error($status, $message)
    {
        return response()->json(['error' => $status,'message'=>$message], $status);
    }
}
