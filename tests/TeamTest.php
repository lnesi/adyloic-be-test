<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    public function testCreateTeam()
    {
        $this->post('/api/teams', ['name'=>'phpunit team']);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit team",
            $response->name
        );
        \App\Team::destroy($response->id);
    }

    public function testGetTeam()
    {
        $team=\App\Team::create(['name'=>'phpunit team']);
        $this->get('/api/teams/'.$team->id);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit team",
            $response->name
        );
        $team->delete();
    }

    public function testUpdateTeam()
    {
        $team=\App\Team::create(['name'=>'phpunit team']);
        $this->patch('/api/teams/'.$team->id, ['name'=>'phpunit team 2']);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "phpunit team 2",
            $response->name
        );
        $team->delete();
    }

    public function testDeleteTeam()
    {
        $team=\App\Team::create(['name'=>'phpunit team']);
        $this->delete('/api/teams/'.$team->id);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "200",
            $response->ok
        );
    }
}
