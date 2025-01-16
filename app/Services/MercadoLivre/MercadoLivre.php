<?php
namespace App\Services\MercadoLivre;

use Illuminate\Support\Facades\Http;
use App\Services\MercadoLivre\EndPoints\CreateItem;
use App\Services\MercadoLivre\EndPoints\GetToken;
use App\Services\MercadoLivre\EndPoints\GetCode;
class MercadoLivre
{
    protected $clientId;
    protected $clientSecret;
    protected $code;
    protected $access_token;
    protected $refresh_token;
    protected $url_create_items;
    protected $url_redirect;
    public function __construct()
    {
        $this->clientId = config('services.mercadolivre.client_id');
        $this->clientSecret = config('services.mercadolivre.client_secret');
        $this->code = config('services.mercadolivre.code'); 
        $this->access_token = config('services.mercadolivre.access_token');
        $this->url_redirect = config('services.mercadolivre.url_redirect');
        $this->refresh_token = config('services.mercadolivre.refresh_token');
        $this->url_create_items = 'https://api.mercadolibre.com/items?access_token=' . $this->access_token;
        $this->url_get_token = 'https://api.mercadolibre.com/oauth/token?' . $this->access_token;
    }
    
    public function create($data, $imageUrl)
    {

        $createItem = new CreateItem();
    
        return $createItem->handle(
            $this->clientId,
            $this->clientSecret,
            $this->code,
            $this->access_token,
            $this->url_create_items,
            $data,
            $imageUrl
        );
    }

    public function getToken()
    {
        $getToken = new GetToken(
            $this->clientId, 
            $this->clientSecret, 
            $this->code, 
            $this->url_redirect
        );
    
        return $getToken->handle($this->url_get_token);
    }

    public function refreshToken($refreshToken)
    {
        $response = Http::post('https://api.mercadolibre.com/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refresh_token,
            'redirect_uri' => $this->url_redirect,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => $response->body()];
        }
    }
}
