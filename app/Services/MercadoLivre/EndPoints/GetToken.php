<?php

namespace App\Services\Mercadolivre\EndPoints;

use Illuminate\Support\Facades\Http;

class GetToken
{
    protected $clientId;
    protected $clientSecret;
    protected $authorizationCode;
    protected $redirectUri;

    public function __construct($clientId, $clientSecret, $authorizationCode, $redirectUri)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authorizationCode = $authorizationCode;
        $this->redirectUri = $redirectUri;
    }

    public function handle($url)
    {
        $response = Http::post($url, [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $this->authorizationCode,
            'redirect_uri' => $this->redirectUri
        ]);

        // Exibe o token independente do sucesso ou erro
        return $response->body();  // Retorna a resposta completa (JSON ou erro como string)
    }
}
