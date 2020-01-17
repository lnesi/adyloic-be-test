<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = ‘players’;
    protected $fillable = [
        'home_team_id',
        'home_score',
        'visit_team_id',
        'visit_score'
    ];
}
