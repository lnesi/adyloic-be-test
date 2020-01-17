<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';
    protected $fillable = [
        'first_name',
        'last_name'
    ];
    protected $hidden=['team_id'];
    protected $with=['team'];
    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
