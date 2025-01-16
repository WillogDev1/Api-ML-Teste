<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <!-- Formulário -->
                    <div class="col-span-2">
                        <form method="POST" action="{{ route('produtos.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
                            @csrf

                            <!-- Nome do Produto -->
                            <div>
                                <x-label :value="'Nome do Produto'" class="py-2" />
                                <x-input name="product_Name" placeholder="Digite o nome do Produto" class="w-full" />
                            </div>

                            <!-- Descrição -->
                            <div>
                                <x-label :value="'Descrição'" class="py-2" />
                                <x-input name="product_Description" placeholder="Digite a Descrição do produto" class="w-full" />
                            </div>

                            <!-- Preço -->
                            <div>
                                <x-label :value="'Preço'" class="py-2" />
                                <x-input-cambio name="product_price" type="number" step="0.01" min="0.01"
                                    placeholder="Digite o preço em reais" class="w-full" />
                            </div>

                            <!-- Quantidade em estoque -->
                            <div>
                                <x-label :value="'Quantidade em estoque'" class="py-2" />
                                <x-input-number name="product_Qtd" placeholder="Digite a quantidade em estoque" class="w-full" />
                            </div>

                            <!-- Categoria -->
                            <div>
                                <x-label :value="'Categoria'" class="py-2" />
                                <x-input name="product_Category" placeholder="Escolha a categoria" value="MLB3530" class="w-full" />
                            </div>

                            <!-- Imagens -->
                            <div>
                                <x-label :value="'Imagens'" class="py-2" />
                                <input type="file" name="images" id="imageInput"
                                    class="w-full text-gray-500 font-medium text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-gray-800 file:hover:bg-gray-700 file:text-white rounded"
                                    required />
                            </div>

                            <!-- Botões -->
                            <div class="text-center">
                                <div class="flex justify-center gap-4 py-8">
                                    <x-button>Cadastrar</x-button>
                                    <x-button type="reset" id="resetButton">Limpar</x-button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Preview da Imagem -->
                    <div class="flex items-center justify-center border rounded-lg bg-gray-100">
                        <img id="imagePreview" class="max-w-full max-h-[300px] object-contain" alt="Preview da Imagem" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para Preview de Imagem -->
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('imagePreview').src = '';
        });
    </script>
</x-app-layout>
