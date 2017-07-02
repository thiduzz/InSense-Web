<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome2');
});

Route::get('/tcc/docs', function () {
    return 'Em breve';
});

Route::get('/equipe', function () {
    return 'Em breve';
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/oauth-controls', 'HomeController@oauth')->name('oauth-controls');

Route::any(config('l5-swagger.config.doc-route') . '/{page?}', function ($page = 'api-docs.json')
{
    $filePath = config('l5-swagger.config.doc-dir') . "/{$page}";

    if (File::extension($filePath) === "")
    {
        $filePath .= ".json";
    }
    if (! File::Exists($filePath))
    {
        App::abort(404, "Cannot find {$filePath}");
    }

    $content = File::get($filePath);

    return Response::make($content, 200, array(
        'Content-Type' => 'application/json',
    ));
});

Route::get(config('l5-swagger.config.api-docs-route'), function ()
{
    if (config('l5-swagger.config.generateAlways'))
    {
        $appDir = base_path() . "/" . config('l5-swagger.config.app-dir');
        $docDir = config('l5-swagger.config.doc-dir');

        if (! File::exists($docDir) || is_writable($docDir))
        {
            // delete all existing documentation
            if (File::exists($docDir))
            {
                File::deleteDirectory($docDir);
            }

            File::makeDirectory($docDir);

            $defaultBasePath       = config('l5-swagger.config.default-base-path');
            $defaultApiVersion     = config('l5-swagger.config.default-api-version');
            $defaultSwaggerVersion = config('l5-swagger.config.default-swagger-version');
            $excludeDirs           = config('l5-swagger.config.excludes');

            $swagger = \Swagger\scan($appDir, [
                'exclude' => $excludeDirs,
            ]);

            $filename = $docDir . '/api-docs.json';
            file_put_contents($filename, $swagger);
        }
    }

    if (config('l5-swagger.config.behind-reverse-proxy'))
    {
        $proxy = Request::server('REMOTE_ADDR');
        Request::setTrustedProxies(array($proxy));
    }


    //need the / at the end to avoid CORS errors on Homestead systems.
    $response = response()->view('l5-swagger::index', array(
            'secure'         => Request::secure(),
            'urlToDocs'      => url(config('l5-swagger.config.doc-route')),
            'requestHeaders' => config('l5-swagger.config.requestHeaders'),
            'clientId'       => Request::input("client_id"),
            'clientSecret'   => Request::input("client_secret"),
            'realm'          => Request::input("realm"),
            'appName'        => Request::input("appName"),
        )
    );

    if (Config::has('swagger.viewHeaders'))
    {
        foreach (config('l5-swagger.config.viewHeaders') as $key => $value)
        {
            $response->header($key, $value);
        }
    }

    return $response;
});

