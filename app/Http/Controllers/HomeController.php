<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Swagger\Annotations as SWG;
/**
 * @SWG\Swagger(
 *     host="insense.vizad.com.br",
 *     schemes={"http"},
 *   @SWG\Info(
 *     title="InSense API",
 *     description="OAuth API para o App InSense.<br><br>Esta API atualmente é somente acessível para o aplicativo Android InSense<br><h2>Integrantes:</h2><ul><li>Thiago Mello</li><li>Rafael Tschannerl</li><li>Matheus Costa Vieira</li></ul>",
 *     version="1.0.0",
 *     contact=@SWG\Contact(
 *         name="Thiago Mello",
 *         email="thiago.mello@vizad.com.br",
 *         url="http://insense.vizad.com.br"
 *     ),
 *     license=@SWG\License(
 *         name="InSense Ltda - ME"
 *     )
 *   ),
 *   @SWG\SecurityScheme(
 *   securityDefinition="Bearer",
 *   type="oauth2",
 *   flow="password",
 *   in="header",
 *   name="Authorization"
 *   ),
 *   security={
 *       {"Bearer": {"api-key"}}
 *   },
 *   @SWG\Parameter(
 *     in="header",
 *     name="Accept",
 *     required=true,
 *     type="string",
 *     default="application/json"
 *   ),
 *  )
 **/
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application passport control.
     *
     * @return \Illuminate\Http\Response
     */
    public function oauth()
    {
        if(Auth::check())
        {
            if(Auth::user()->hasRole('admin'))
            {
                return view('auth.oauth_control');
            }
            abort(403);
        }
    }
}
