<?php

namespace App\Http\Controllers;

use \App\Team;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class TeamController extends ApiController
{
    protected $modelClass=\App\Team::class;

    public function create(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $team=new Team($_POST);
        $team->save();
        return $team;
    }

  

    //
}
