<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

$test_buffer=null;
class TransferTest extends TestCase
{
    public function testAddPlayerToTeam()
    {
        $player=\App\Player::create(['first_name'=>'phpunit','last_name'=>'player']);
        $team=\App\Team::create(['name'=>'phpunit team']);
        $this->post('/api/transfer', ['teamid'=>$team->id,'playerid'=>$player->id]);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            $team->name,
            $response->team->name
        );
    }

    public function testLimitMaxPlayerPerTeam8()
    {
        $team=\App\Team::create(['name'=>'phpunit team']);
        $player=\App\Player::create(['first_name'=>'phpunit','last_name'=>'player']);
        $players=[];
        for ($i=0;$i<8;$i++) {
            $player=\App\Player::create(['first_name'=>'phpunit'.$i,'last_name'=>'player'.$i]);
            $player->team_id=$team->id;
            $player->save();
            $player->refresh();
            
            array_push($players, $player);
        }
        $this->assertEquals(
            8,
            $team->players()->get()->count()
        );
        $this->post('/api/transfer', ['teamid'=>$team->id,'playerid'=>$player->id]);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            422,
            $response->error
        );
        $this->assertEquals(
            8,
            $team->players()->get()->count()
        );
        $team->delete();
        foreach ($players as &$player) {
            $player->delete();
        }
    }
}
