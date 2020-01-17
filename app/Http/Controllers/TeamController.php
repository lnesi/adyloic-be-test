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
        $team=new Team($request->all());
        $team->save();
        return $team;
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $team=Team::find($id);
        if ($team) {
            $team->name=$request->get('name');
            $team->save();
            return $team;
        } else {
            return $this->notFound();
        }
    }


    public function getPlayers($id)
    {
        $team=Team::find($id);
        if ($team) {
            return $team->players()->without(['team'])->get();
        } else {
            return $this->notFound();
        }
    }

    //
}
