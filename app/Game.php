<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = ‘players’;
    protected $fillable = [
        'home_score',
        'visit_score'
    ];
}
