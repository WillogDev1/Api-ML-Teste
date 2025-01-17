# Guia de Instalação e Configuração

Este guia orienta sobre como configurar um ambiente de desenvolvimento local utilizando XAMPP, Laravel e Node.js/NPM.

---

## 1. Instalação do XAMPP

### Download do XAMPP:

Acesse o site oficial do XAMPP: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)

Escolha a versão adequada para o seu sistema operacional e faça o download.

### Instalação:

- Execute o arquivo .exe baixado.
- Siga as instruções no instalador para instalar o XAMPP.

### Iniciar o XAMPP:

- Após a instalação, inicie o XAMPP Control Panel.
- Inicie os módulos Apache e MySQL.

### Verificar Funcionamento:

- Acesse [http://localhost](http://localhost) para verificar se o Apache está funcionando corretamente.

---

## 2. Instalação do Laravel

### Instalar Composer:

Acesse o site oficial do Composer: [https://getcomposer.org/](https://getcomposer.org/)

Baixe e instale o Composer seguindo as instruções.

### Criar Projeto Laravel:

Após o Composer estar instalado, abra o terminal e navegue até a pasta onde deseja criar o projeto Laravel.

1. Vá até a pasta `XAMPP/htdocs`.
2. Exclua todo o conteúdo existente.
Execute o comando:
```bash
composer global require laravel/installer
```
3. Escolha Livewire / Jetstream.

4. Cole o conteúdo da pasta `exemplo-app` do Laravel.

## 3. Instalação do Node.js e NPM

### Download e Instalação do Node.js

1. Acesse o site oficial do Node.js: [https://nodejs.org/](https://nodejs.org/)
2. Faça o download da versão LTS ou mais recente.
3. Instale Node.js e npm.

### Verificar Instalação

Verifique se o Node.js e o npm foram instalados corretamente executando os seguintes comandos no terminal:

```bash
node -v
npm -v
```

Acesse a pasta htdocs e rode
```bash
npm run build
```

# Configuração das Variáveis .env

Você precisa configurar as seguintes variáveis no seu arquivo `.env` para autenticar com o Mercado Livre:

## Variáveis:

1. **ML_CLIENT_ID**:  
   - Este é o seu **Client ID** fornecido pelo Mercado Livre.  
   - Exemplo: `ML_CLIENT_ID=seu-client-id-aqui`

2. **ML_CLIENT_SECRET**:  
   - Este é o seu **Client Secret** fornecido pelo Mercado Livre.  
   - Exemplo: `ML_CLIENT_SECRET=seu-client-secret-aqui`

3. **ML_CODE**:  
   - Usado durante o fluxo de autorização do Mercado Livre. Deixe vazio por enquanto.  
   - Exemplo: `ML_CODE=`

4. **ML_ACCESS_TOKEN**:  
   - Token de acesso fornecido após a autorização bem-sucedida.  
   - Exemplo: `ML_ACCESS_TOKEN=`

5. **ML_REFRESH_TOKEN**:  
   - Token usado para obter um novo **access_token** quando o anterior expirar.  
   - Exemplo: `ML_REFRESH_TOKEN=`

6. **ML_URL**:  
   - URL da API do Mercado Livre, geralmente não precisa ser alterada.  
   - Exemplo: `ML_URL=`

### Exemplo Final:

ML_CLIENT_ID=123456789  
ML_CLIENT_SECRET=abcdef123456  
ML_CODE=  
ML_ACCESS_TOKEN=  
ML_REFRESH_TOKEN=  
ML_URL=  

**Preencha apenas ML_CLIENT_ID e ML_CLIENT_SECRET**.

Depois, rode:

    php artisan optimize  

Ao acessar a página de `/integracao`, clique em "Autorizar Aplicação" para gerar seu Code.

Salve o Code no arquivo `.env` como `ML_CODE` e, novamente, rode:

    php artisan optimize  

Cole o Code gerado em "Obter Access Token" e clique em "Obter".

Salve `ML_ACCESS_TOKEN` e `ML_REFRESH_TOKEN` no arquivo `.env` e rode:

    php artisan optimize  


## Observações:

O cadastro do produto foi limitado à categoria **MLB3530**. Cada categoria possui diferentes campos obrigatórios, como ISBN, Cor, etc. Esta categoria é genérica e está disponível na documentação da API do Mercado Livre.

Portanto, não foi implementada a opção de escolha de categorias específicas, pois isso poderia resultar em erros inesperados.

Além disso, optei por não salvar as variáveis no banco de dados por cautela. Decidi mantê-las no arquivo `.env`, o que torna o aplicativo um pouco "engessado". No entanto, como não tenho certeza se seria uma boa prática armazenar essas informações no banco ou em sessão, preferi seguir essa abordagem.

