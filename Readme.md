# Servidor HTTP Simples em PHP com Sockets

## Descrição

Este projeto é um servidor HTTP básico criado em PHP usando sockets. Ele serve como uma ferramenta educacional para entender como servidores funcionam em um nível fundamental. Com este servidor, você pode aceitar requisições de navegadores ou de outras ferramentas HTTP e enviar respostas personalizadas, tudo sem depender de servidores web tradicionais como Apache ou Nginx.

### Funcionalidades

- **Criação de Socket:** O servidor cria um socket TCP/IP que permite comunicação pela rede, escutando conexões na porta que você escolher.
- **Associação (Bind) do Socket:** O servidor vincula o socket ao endereço IP e à porta especificados, tornando-o acessível para receber conexões.
- **Escuta de Conexões:** O servidor fica escutando por novas conexões de clientes, aceitando uma conexão por vez.
- **Processamento de Requisições HTTP:** Ele lê e interpreta a requisição enviada pelo cliente, como o método (GET, POST), o caminho da URL, cabeçalhos, e parâmetros.
- **Envio de Respostas HTTP:** Com base na requisição, o servidor gera e envia uma resposta, incluindo um status (como 200 OK), cabeçalhos e o conteúdo desejado.
- **Sistema  de Logs:** O servidor registra informações sobre as requisições recebidas, incluindo o método, a URL, o endereço IP do cliente, e a hora da requisição.

### Acessibilidade

Este servidor pode ser acessado de qualquer computador na mesma rede local (Wi-Fi, Ethernet) usando o endereço IP do computador onde o servidor está rodando. Por exemplo, se você está executando o servidor em um PC de mesa, pode acessá-lo pelo navegador de um notebook, smartphone, ou qualquer outro dispositivo conectado à mesma rede.

## Estrutura do Projeto

- `Server.php`: Gerencia o ciclo de vida do servidor, desde a criação do socket até a resposta final ao cliente.
- `Request.php`: Representa a requisição HTTP recebida, lidando com detalhes como o método (GET, POST), o caminho da URL, os cabeçalhos e os parâmetros.
- `Response.php`: Estrutura a resposta HTTP que será enviada de volta ao cliente, contendo o status, cabeçalhos e o corpo da mensagem.

## Como Utilizar

1. Clone o repositório:

   ```bash
   git clone https://github.com/MatheusSan99/nome-do-repositorio.git
   ```

2. Instale as dependências via Composer:

   ```bash
   composer install
   ```

3. Execute o servidor:

   ```bash
   php -f openServer.php 0.0.0.0:8080
   ```

   O servidor será iniciado e ficará escutando por conexões na porta `8080`. Você pode alterar a porta para qualquer outra que desejar, 
   ou não passar nenhum parâmetro que usará `127.0.0.1:8080` por padrão.

4. Acesse o servidor a partir de qualquer dispositivo na mesma rede:

   Abra um navegador ou use ferramentas como `curl` e acesse:

   ```bash
   http://[endereço-ip-do-servidor]:8080/
   ```

   Substitua `[endereço-ip-do-servidor]` pelo endereço IP do computador onde o servidor está rodando. Por exemplo, se o IP for `192.168.0.10`, o endereço completo seria:

   ```bash
   http://192.168.0.10:8080/
   ```

Agora você tem um servidor básico rodando, acessível a partir de qualquer dispositivo na mesma rede!

## Aviso Importante

Este tutorial tem o objetivo de demonstrar como criar um servidor HTTP simples em PHP e proporcionar uma visão básica de como servidores funcionam. No entanto, é importante entender que PHP não é ideal para servir como um servidor web de produção.

PHP é uma linguagem de script que não foi projetada para longas execuções de processos, como um servidor web. Além disso, PHP não suporta nativamente multi-threading, o que torna a construção de um servidor web de alto desempenho bastante desafiadora. O gerenciamento de memória e o overhead do interpretador também podem limitar a eficiência e a escalabilidade.

Embora o PHP tenha evoluído muito e continue a ser amplamente utilizado, criar servidores web de produção com PHP não é uma prática recomendada. Para ambientes de produção, é melhor utilizar servidores web especializados e mais adequados para lidar com cargas pesadas e múltiplas conexões simultâneas.
e isso ajude a tornar a documentação mais clara e informativa!