<?php

class SwaggerNotations
{
    /**
     * @SWG\Post(
     *   tags={"OAuth"},
     *   path="/oauth/token",
     *   summary="Request Access Token",
     *   description="<h2>Chamada para solicitar o primeiro acesso</h2> <p>Você deve enviar como form-data alguns dados para obter um access_token e refresh_token.<br><b>Exemplo:<br> http://api.cetac.vizad.com.br/oauth/token</b><br>Tempo de validade do Access Token: 7 dias<br>Tempo de validade do Token de Atualização: 15 dias<br>Para ter um novo access token depois do inicial, por questões de segurança, é recomendado usar o 'refresh_token' em vez de 'username' e 'password'.</p><br>",
     *   consumes={"application/json"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     name="client_id",
     *     in="formData",
     *     description="ID for the client (Each application should have one)",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="client_secret",
     *     in="formData",
     *     description="Secret for the client (Request to the system admin)",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="grant_type",
     *     in="formData",
     *     description="If first access pick 'password', if needs to refresh the access token pick 'refresh_token'",
     *     required=true,
     *     type="string",
     *     enum={"password","refresh_token"}
     *   ),
     *   @SWG\Parameter(
     *     name="refresh_token",
     *     in="formData",
     *     description="A not expired and valid refresh token (mandatory if grant_type = 'refresh_token')",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="username",
     *     in="formData",
     *     description="The username sent by the system administrator (mandatory if grant_type = 'password')",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="The password sent by the system administrator (mandatory if grant_type = 'password')",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Return the successfull message"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     *
     **/
}