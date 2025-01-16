<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\MercadoLivre\MercadoLivre;
use Illuminate\Support\Facades\Config;


class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'product_Name' => 'required|string|max:255',
            'product_Description' => 'required|string',
            'product_price' => 'required|numeric|min:0.01',
            'product_Qtd' => 'required|integer|min:0',
            'product_Category' => 'required|string',
            'images' => 'required|image',
        ]);

        $imageUrl = null;

        // Salvar imagem no diretório 'storage'
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $path = $file->store('images', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        // Criação do registro no banco de dados com o modelo Product
        $product = Product::create([
            'product_Name' => $validated['product_Name'],
            'product_Description' => $validated['product_Description'],
            'product_price' => $validated['product_price'],
            'product_Qtd' => $validated['product_Qtd'],
            'product_Category' => $validated['product_Category'],
        ]);

        return $this->createProductInMercadoLivre($validated, $imageUrl);
    }

    private function createProductInMercadoLivre($validated, $imageUrl)
    {
        $mercadoLivreService = new MercadoLivre();
        return $mercadoLivreService->create($validated, $imageUrl);
    }

    public function getToken(Request $request)
    {
        $authorizationCode = $request->input('code');
        $mercadoLivreService = new MercadoLivre();

        $response = $mercadoLivreService->getToken($authorizationCode);

        // Retornar resposta como JSON ou renderizar uma página
        return response()->json($response);
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = $request->input('refresh_token');
        $mercadoLivreService = new MercadoLivre();
        $response = $mercadoLivreService->refreshToken($refreshToken);

        // Exibir ou manipular a resposta conforme necessário
        return response()->json($response);
    }



    public function showIntegration()
    {
        $appId = Config::get('services.mercadolivre.client_id');
        $redirectUri = Config::get('services.mercadolivre.url_redirect');
        $url = "https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={$appId}&redirect_uri={$redirectUri}";
    
        return view('integration', ['mercadoLivreUrl' => $url]);
    }


}
