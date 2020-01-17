<?php

namespace App\Http\Controllers;

use \App\Player;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class PlayerController extends ApiController
{
    protected $modelClass=\App\Player::class;

    public function create(Request $request)
    {
        $this->validate($request, ['first_name' => 'required','last_name' => 'required']);
        $player=new Player($request->all());
        $player->save();
        return $player;
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['first_name' => 'required','last_name' => 'required']);
        $player=Player::find($id);
        if ($player) {
            $player->first_name=$request->get('first_name');
            $player->last_name=$request->get('last_name');
            $player->save();
            return $player;
        } else {
            return $this->notFound();
        }
    }

  

    //
}
