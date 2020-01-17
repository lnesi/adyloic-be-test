<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

$test_buffer=null;
class PlayerTest extends TestCase
{
    public function testCreatePlayer()
    {
        $this->post('/api/players', ['first_name'=>'phpunit','last_name'=>'player']);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit",
            $response->first_name
        );
        $this->assertEquals(
            "player",
            $response->last_name
        );
        \App\player::destroy($response->id);
    }

    public function testGetPlayer()
    {
        $player=\App\player::create(['first_name'=>'phpunit','last_name'=>'player']);
        $this->get('/api/players/'.$player->id);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit",
            $response->first_name
        );
        $this->assertEquals(
            "player",
            $response->last_name
        );
        $player->delete();
    }

    public function testUpdatePlayer()
    {
        $player=\App\player::create(['first_name'=>'phpunit','last_name'=>'player']);
        $this->patch('/api/players/'.$player->id, ['first_name'=>'phpunit2','last_name'=>'player2']);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit2",
            $response->first_name
        );
        $this->assertEquals(
            "player2",
            $response->last_name
        );
        $player->delete();
    }

    public function testDeletePlayer()
    {
        $player=\App\player::create(['first_name'=>'phpunit','last_name'=>'player']);
        $this->delete('/api/players/'.$player->id);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "200",
            $response->ok
        );
    }
}
