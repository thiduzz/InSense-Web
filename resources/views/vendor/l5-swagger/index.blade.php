<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="icon" type="image/png" href="{{ asset('vendor/l5-swagger/images/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('vendor/l5-swagger/images/favicon-16x16.png') }}" sizes="16x16"/>
    <link href="{{ asset('vendor/l5-swagger/css/typography.css') }}" media="screen" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/l5-swagger/css/reset.css') }}" media="screen" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/l5-swagger/css/screen.css') }}" media="screen" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/l5-swagger/css/reset.css') }}" media="print" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/l5-swagger/css/print.css') }}" media="print" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('vendor/l5-swagger/lib/jquery-1.8.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/jquery.slideto.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/jquery.wiggle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/jquery.ba-bbq.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/handlebars-2.0.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/js-yaml.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/lodash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/backbone-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/swagger-ui.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/highlight.9.1.0.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/highlight.9.1.0.pack_extended.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/jsoneditor.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/marked.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/l5-swagger/lib/swagger-oauth.js') }}" type="text/javascript"></script>

    <!-- Some basic translations -->
    <!-- <script src='lang/translator.js' type='text/javascript'></script> -->
    <!-- <script src='lang/ru.js' type='text/javascript'></script> -->
    <!-- <script src='lang/en.js' type='text/javascript'></script> -->

    <script type="text/javascript">
        $(function () {
            var url = "{!! $urlToDocs !!}";

            hljs.configure({
                highlightSizeThreshold: 5000
            });

            // Pre load translate...
            if (window.SwaggerTranslator) {
                window.SwaggerTranslator.translate();
            }
            window.swaggerUi = new SwaggerUi({
                url: url,
                dom_id: "swagger-ui-container",
                supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                onComplete: function (swaggerApi, swaggerUi) {
                    log("Loaded SwaggerUI");
                    @if (isset($requestHeaders))
                    @foreach($requestHeaders as $requestKey => $requestValue)
                    window.authorizations.add("{!!$requestKey!!}", new ApiKeyAuthorization("{!!$requestKey!!}", "{!!$requestValue!!}", "header"));
                    @endforeach
                    @endif
//                    if (typeof initOAuth == "function") {
//                        initOAuth({
//                            clientId: "your-client-id",
//                            clientSecret: "your-client-secret-if-required",
//                            realm: "your-realms",
//                            appName: "your-app-name",
//                            scopeSeparator: ",",
//                            additionalQueryStringParams: {}
//                        });
//                    }

                    if (window.SwaggerTranslator) {
                        window.SwaggerTranslator.translate();
                    }

                    addApiKeyAuthorization();
                },
                onFailure: function (data) {
                    log("Unable to Load SwaggerUI");
                },
                docExpansion: "none",
                jsonEditor: false,
                apisSorter: "alpha",
                defaultModelRendering: 'schema',
                showRequestHeaders: false
            });

            function addApiKeyAuthorization() {
                var key = encodeURIComponent($('#input_apiKey')[0].value);
                if (key && key.trim() != "") {
                    log("added key " + key);
                    var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization("{!! config('l5-swagger.config.api-key') !!}", key, "query");
                    window.swaggerUi.api.clientAuthorizations.add("api_key", apiKeyAuth);
                    log("added key " + key);
                }
            }

            $('#input_apiKey').change(addApiKeyAuthorization);

            // if you have an apiKey you would like to pre-populate on the page for demonstration purposes...
            /*
             var apiKey = "myApiKeyXXXX123456789";
             $('#input_apiKey').val(apiKey);
             */

            window.swaggerUi.load();

            function log() {
                if ('console' in window) {
                    console.log.apply(console, arguments);
                }
            }
        });
    </script>
</head>

<body class="swagger-section">
<div id="header">
    <div class="swagger-ui-wrap">
        <a id="logo" href="http://swagger.io">swagger</a>

        <form id="api_selector">
            <div class="input">
                <input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text"/></div>
            <div class="input">
                <input placeholder="{!! config('l5-swagger.config.api-key') !!}" id="input_apiKey" name="apiKey" type="text"/>
            </div>
            <div class="input"><a id="explore" href="#" data-sw-translate>Explore</a></div>
        </form>
    </div>
</div>

<div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</body>
</html>
