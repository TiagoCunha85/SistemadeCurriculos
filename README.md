# Sistema de Envio de Currículos

## Visão Geral
Este sistema em PHP é utilizado para receber currículos de candidatos, armazená-los em um banco de dados MySQL e enviar um e-mail de confirmação para o candidato.

## Requisitos
- Servidor web com suporte a PHP
- Banco de dados MySQL

## Funcionalidades
- **Recebimento de Currículos:** Os candidatos podem enviar seus currículos através de um formulário web.
- **Armazenamento em Banco de Dados:** Os currículos são armazenados em um banco de dados MySQL para posterior análise.
- **Envio de E-mail de Confirmação:** Após o envio bem-sucedido do currículo, um e-mail de confirmação é enviado para o candidato.

## Como Usar
1. Clone este repositório em seu servidor web.
2. Configure o acesso ao banco de dados editando as variáveis `$host`, `$dbname`, `$username` e `$password` no arquivo `index.php`.
3. Certifique-se de que o diretório `uploads/` tem permissão de escrita.
4. Acesse o formulário de envio de currículos pelo navegador.

## Estrutura do Projeto
- **index.php:** Contém o código PHP responsável pelo recebimento e processamento do formulário de envio de currículos.
- **uploads/:** Diretório para armazenar os currículos enviados pelos candidatos.
- **vendor/:** Diretório que contém as bibliotecas PHPMailer para envio de e-mails.

## Dependências
Este projeto utiliza a biblioteca PHPMailer para o envio de e-mails. Certifique-se de incluir ou instalar as dependências conforme descrito no código PHP.

## Contribuição
Contribuições são bem-vindas! Se você identificar algum problema ou tiver sugestões de melhorias, sinta-se à vontade para abrir uma issue ou enviar um pull request.

## Licença
Este projeto é licenciado sob a [MIT License](LICENSE).
