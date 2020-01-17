<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'home_team_id',
        'visit_team_id',
    ];
    
    protected $hidden= [
        'home_team_id',
        'visit_team_id',
    ];

    protected $with=['home_team','visit_team'];

    public function home_team()
    {
        return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function visit_team()
    {
        return $this->belongsTo('App\Team', 'visit_team_id');
    }
}
