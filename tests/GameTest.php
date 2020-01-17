<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

$test_buffer=null;
class GameTest extends TestCase
{
    public function testCreateGame()
    {
        $home_team=\App\Team::create(['name'=>'Test Home Team']);
        $visit_team=\App\Team::create(['name'=>'Test Visit Team']);

        $this->post('/api/games', [
          'home_team_id'=>$home_team->id,
          'visit_team_id'=>$visit_team->id]);
        $response=json_decode($this->response->getContent());
      
       
        $this->assertEquals(
            $home_team->name,
            $response->home_team->name
        );

        $this->assertEquals(
            $visit_team->name,
            $response->visit_team->name
        );
        $this->assertEquals(0, $response->home_score);
        $this->assertEquals(0, $response->visit_score);
        \App\Game::destroy($response->id);
        \App\Team::destroy($home_team->id);
        \App\Team::destroy($visit_team->id);
    }

    public function testDeleteGame()
    {
        $home_team=\App\Team::create(['name'=>'Test Home Team']);
        $visit_team=\App\Team::create(['name'=>'Test Visit Team']);
        $game=\App\Game::create([
          'home_team_id'=>$home_team->id,
          'visit_team_id'=>$visit_team->id]);
        $this->delete("/api/games/".$game->id);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "200",
            $response->ok
        );
    }

    public function testUpdateScore()
    {
        $home_team=\App\Team::create(['name'=>'Test Home Team']);
        $visit_team=\App\Team::create(['name'=>'Test Visit Team']);
        $game=\App\Game::create([
          'home_team_id'=>$home_team->id,
          'visit_team_id'=>$visit_team->id]);
        $this->patch('/api/games/'.$game->id.'/update_score', [
          'home_score'=>2,
          'visit_score'=>3
        ]);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "2",
            $response->home_score
        );
        $this->assertEquals(
            "3",
            $response->visit_score
        );
        $game->delete();
        $home_team->delete();
        $visit_team->delete();
    }
}
