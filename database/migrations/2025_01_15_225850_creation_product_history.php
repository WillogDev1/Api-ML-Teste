<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('creation_product_history', function (Blueprint $table) {
            $table->id();
            $table->string('product_Name')->nullable();
            $table->string('product_Description')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_Qtd')->nullable();
            $table->string('product_Category')->nullable();
            $table->string('error_creation')->nullable();
            $table->enum('product_Status', ['Rascunho', 'Cadastrado', 'Erro'])->default('Rascunho');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
