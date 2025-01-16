<?php

namespace App\Services\Mercadolivre\EndPoints;

use Illuminate\Support\Facades\Http;

/**
 * Classe responsável por gerenciar as interações com a API Mercado Livre.
 */
class CreateItem
{
    /**
     * Faz a requisição para criar um documento na API do Mercado Livre.
     *
     * @param 
     */
    public function handle($clientId, $clientSecret, $code, $access_token, $url, $data, $img)
    {

        $response = Http::post($url, [
            'title'                 => $data['product_Name'],
            'category_id'           => $data['product_Category'],
            'price'                 => $data['product_price'],
            'currency_id'           => 'BRL',
            'available_quantity'    => $data['product_Qtd'],
            'buying_mode'           => 'buy_it_now',
            'condition'             => 'new',
            'listing_type_id'       => 'bronze',
            'pictures'  => [ 
                ['source' => $img],
            ],  
            'description'           => $data['product_Description'],
            'attributes' => [
                ['id' => 'BRAND', 'value_name' => 'Marca del producto'],
                ['id' => 'MODEL', 'value_name' => 'Model del producto'],
                ['id' => 'EAN', 'value_name' => '7898095297749'],
            ],
        ]);
        // Id da publicação para inserir imagem
        return $response->json();
        $id = $response['id'];


        $urlUpload = "https://api.mercadolibre.com/pictures/items/upload?access_token={$access_token}";
        $imageUrl = $img; 

        $responseUpload = Http::attach('file', file_get_contents($imageUrl), 'imagem.jpg')->post($urlUpload);

        if (!$responseUpload->successful()) {
            return $responseUpload->json(); 
        }

        $pictureId = $responseUpload['id'];

        $urlPicture = "https://api.mercadolibre.com/items/{$id}/pictures?access_token={$access_token}";
        
        $responsePicture = Http::post($urlPicture, [
            'id' => $pictureId
        ]);

        if (!$responsePicture->successful()) {
            return $responsePicture->json(); 
        }

        if ($response->successful()) {
            return $response->json();
        }

        return $response->json(); 
    }
}
