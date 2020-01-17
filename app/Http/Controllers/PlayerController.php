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
        $player=new Player($_POST);
        $player->save();
        return $player;
    }

    

  

    //
}
