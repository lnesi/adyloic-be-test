<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

$test_buffer=null;
class TeamTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testCreateTeam()
    {
        global $test_buffer;
        $this->post('/api/teams', ['name'=>'php unit team']);
        $response=json_decode($this->response->getContent());
        $test_buffer=$response->id;
        $this->assertEquals(
            "php unit team",
            $response->name
        );
    }

    public function testGetTeam()
    {
        global $test_buffer;
        $this->get('/api/teams/'.$test_buffer);
        $response=json_decode($this->response->getContent());
        $test_buffer=$response->id;
        $this->assertEquals(
            "php unit team",
            $response->name
        );
    }

    public function testDeleteTeam()
    {
        global $test_buffer;
        $this->delete('/api/teams/'.$test_buffer);
        $response=json_decode($this->response->getContent());
        $this->assertEquals(
            "200",
            $response->ok
        );
    }
}
