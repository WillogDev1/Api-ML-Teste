<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Integração Mercado Livre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <!-- Seção de URL para Autorizar -->
                    <div class="max-w-4xl mx-auto p-6">
                        <h1 class="text-3xl font-semibold text-center mb-6">Integração com Mercado Livre</h1>
                        <p class="text-lg mb-4">Clique no link abaixo para autorizar a aplicação:</p>

                        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <a href="{{ $mercadoLivreUrl }}" target="_blank"
                               class="text-indigo-600 font-bold hover:underline">
                                Autorizar Aplicação
                            </a>
                        </div>

                        <p class="mt-4 text-lg">
                            Após a autorização, copie o código gerado e insira na próxima etapa.
                        </p>
                    </div>

                    <!-- Formulário para Obter Access Token -->
                    <div class="max-w-4xl mx-auto p-6">
                        <h1 class="text-3xl font-semibold text-center mb-6">Obter Access Token</h1>
                        <p class="text-lg mb-4">Cole o código recebido após a autorização e clique em "Obter Token".</p>

                        <!-- Mensagens de Sucesso ou Erro -->
                        @if (session('success'))
                            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Formulário -->
                        <form method="GET" action="{{ url('/obter-token') }}">
                            <div class="mt-6">
                                <label for="code" class="block text-sm font-medium text-gray-700">Insira o código:</label>
                                <input type="text" name="code" id="code" 
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    placeholder="Digite o código de autorização" required>
                            </div>
                            <div class="mt-6">
                                <button type="submit" 
                                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Obter Access Token
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Formulário para Renovar Access Token -->
                    <div class="max-w-4xl mx-auto p-6">
                        <h1 class="text-3xl font-semibold text-center mb-6">Renovar Access Token</h1>
                        <p class="text-lg mb-4">Cole o token de renovação e clique em "Renovar Token".</p>

                        <!-- Mensagens de Sucesso ou Erro -->
                        @if (session('success_renew'))
                            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                                {{ session('success_renew') }}
                            </div>
                        @endif

                        @if (session('error_renew'))
                            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                                {{ session('error_renew') }}
                            </div>
                        @endif

                        <!-- Formulário -->
                        <form method="POST" action="{{ url('/renovar-token') }}">
                            @csrf
                            <div class="mt-6">
                                <label for="refresh_token" class="block text-sm font-medium text-gray-700">Insira o refresh token:</label>
                                <input type="text" name="refresh_token" id="refresh_token" 
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    placeholder="Digite o refresh token" required>
                            </div>
                            <div class="mt-6">
                                <button type="submit" 
                                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Renovar Access Token
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
