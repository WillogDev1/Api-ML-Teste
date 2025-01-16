<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Definindo o nome da tabela (se a tabela não seguir a convenção do Laravel)
    protected $table = 'creation_product_history'; // Caso o nome da tabela não seja o plural de 'Product'

    // Definindo os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'product_Name', // Nome do produto
        'product_Description', // Descrição do produto
        'product_price', // Preço do produto
        'product_Qtd', // Quantidade do produto em estoque
        'product_Category', // Categoria do produto
    ];

    // Definindo os campos que não podem ser preenchidos em massa (opcional)
    // protected $guarded = ['id']; // Isso impede o preenchimento do campo 'id' diretamente

    // Se for necessário trabalhar com datas, você pode adicionar os campos 'created_at' e 'updated_at' automaticamente
    public $timestamps = true;
}
