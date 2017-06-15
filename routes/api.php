<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * @SWG\Get(
 *   tags={"OAuth"},
 *   path="/api/user",
 *   summary="Request User",
 *   description="<h2>Chamada para autenticar o usuário da API</h2><br>",
 *   consumes={"application/json"},
 *   produces={"application/json"},
 *   @SWG\Parameter(
 *     name="access_token",
 *     in="formData",
 *     description="The access token obtained in the oauth/token call",
 *     required=true,
 *     type="integer"
 *   ),
 *   @SWG\Response(
 *     response=200,
 *     description="Return the user with its devices and role"
 *   ),
 *   @SWG\Response(
 *     response="default",
 *     description="an ""unexpected"" error"
 *   )
 * )
 *
 **/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return User::with('devices','role')->find($request->user()->id);
});
