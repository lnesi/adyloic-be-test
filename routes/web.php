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
 *   description="Adylic Test Sport Api",
 *   @OA\Contact(
 *         email="luisenesi@gmail.com"
 *     ),
 * )
 *
 * @OA\Tag(
 *     name="team",
 *     description="Football Team",
 * )
 *
 * @OA\Tag(
 *     name="player",
 *     description="Player",
 * )
 *
 * @OA\Tag(
 *     name="game",
 *     description="Football Game Match",
 * )
 * */


$router->get('/', function () use ($router) {
    return redirect('/api/documentation');
});

$router->group(['prefix' => 'api/'], function () use ($router) {

    /**
     * @OA\Get(
     *     path="/api/teams/{teamid}",
     *     tags={"team"},
     *     description="Get Team by ID",
     *     @OA\Parameter(
     *         name="teamid",
     *         in="path",
     *         description="Id of Team",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         explode=false
     *     ),
     *    @OA\Response(response=404, description="Not Found"),
     *    @OA\Response(response=200, description="Team Object")
     * )
     */
    $router->get('teams/{id}', 'TeamController@getById');


    /**
     * @OA\Get(
     *     path="/api/teams",
     *     tags={"team"},
     *     description="Get Teams",
     *     @OA\Response(response="200", description="Team Array")
     * )
     */
    $router->get('teams', 'TeamController@getAll');
    
    /**
    * @OA\Post(
    *     path="/api/teams",
    *     tags={"team"},
    *     operationId="addTeam",
    *     description="Create All Teams",
    *     @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="Team Name",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         explode=false
    *     ),
    *     @OA\Response(response=422, description="Invalid input"),
    *     @OA\Response(response=200, description="Team")
    * )
    */
    $router->post('teams', 'TeamController@create');

    /**
    * @OA\Delete(
    *     path="/api/teams/{teamid}",
    *     tags={"team"},
    *     description="Delete Team",
     *     @OA\Parameter(
     *         name="teamid",
     *         in="path",
     *         description="Id of Team",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         explode=false
     *     ),
     *    @OA\Response(response=404, description="Not Found"),
     *    @OA\Response(response=200, description="Ok")
    * )
    */
    $router->delete('teams/{id}', 'TeamController@delete');

    /**
     * @OA\Get(
     *     path="/api/players/{id}",
     *     tags={"player"},
     *     description="Get Player by ID",
     *     @OA\Response(response="200", description="Player")
     * )
     */
    $router->get('players/{id}', 'PlayerController@getById');

    /**
    * @OA\Get(
    *     path="/api/players",
    *     tags={"player"},
    *     description="Get Players list",
    *     @OA\Response(response="200", description="Player Array")
    * )
    */
    $router->get('players', 'PlayerController@getAll');
    
    /**
    * @OA\Post(
    *     path="/api/players",
    *     tags={"player"},
    *     description="Create Player",
    *     @OA\Response(response="200", description="Player")
    * )
    */
    $router->post('players', 'PlayerController@create');

    /**
    * @OA\Delete(
    *     path="/api/players/{id}",
    *     tags={"player"},
    *     description="Delete Player by id",
    *     @OA\Response(response="200", description="ok")
    * )
    */
    $router->delete('players/{id}', 'PlayerController@delete');
});
