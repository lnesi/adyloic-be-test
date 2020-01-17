<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Adylic Test Api",
 *   description="Adylic Test Sport Api"
 * )
 * */
$router->get('/', function () use ($router) {
    return redirect('/api/documentation');
});

$router->group(['prefix' => 'api/'], function () use ($router) {
    /**
     * @OA\Get(
     *     path="/api/teams",
     *     description="Get Teams",
     *     @OA\Response(response="default", description="Get Team List")
     * )
     */
    $router->get('teams', 'TeamController@getAll');
    
    /**
    * @OA\Post(
    *     path="/api/teams",
    *     description="Create Team",
    *     @OA\Response(response="default", description="TeamObject")
    * )
    */
    $router->post('teams', 'TeamController@create');

    /**
    * @OA\Delete(
    *     path="/api/teams/{id}",
    *     description="Delete Team",
    *     @OA\Response(response="default", description="TeamObject")
    * )
    */
    $router->delete('teams/{id}', 'TeamController@delete');


    /**
     * @OA\Get(
     *     path="/api/teams/{id}",
     *     description="Get Team by ID",
     *     @OA\Response(response="default", description="Team Object")
     * )
     */
    $router->get('teams/{id}', 'TeamController@getById');

    /**
    * @OA\Get(
    *     path="/api/players",
    *     description="Get Players list",
    *     @OA\Response(response="default", description="Get Player List")
    * )
    */
    $router->get('players', 'PlayerController@getAll');
});
