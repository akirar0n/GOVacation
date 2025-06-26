# 🏨 GOVacation
Um site simples de reservas de hotel, com conta para o administrador fazer gestão e o cliente efetuar a reserva da locação requerida.
![image](https://github.com/user-attachments/assets/6bf09555-9823-4ed3-9b8c-ccc7125e93ee)

## 💻 Pré-requisitos
Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:

[XAMPP](https://www.apachefriends.org/download.html): Necessário para rodar o ambiente de servidor local (Apache, MySQL).

[ngrok](https://dashboard.ngrok.com/get-started/setup/windows): Necessário para expor seu servidor local à internet e permitir o funcionamento da API do MercadoPago.

## ☕ Como Usar o GOVacation
Para instalar e rodar o projeto em sua máquina, siga os passos abaixo:

1. Baixe os executáveis do XAMPP e do ngrok.

2. Faça o download do projeto GOVacation.

3. Salve a pasta do projeto dentro do diretório htdocs da sua instalação do XAMPP. (IMPORTANTE!)

4. Abra o painel de controle do XAMPP e inicie os módulos Apache e MySQL.

5. Crie o banco de dados utilizando o phpMyAdmin. O script de criação do banco de dados está localizado em: GOVacation/govac/database/govacation.sql.

    5.1. Após importar o banco, você precisa alterar manualmente a criptografia das senhas dos usuários padrão (adm e cliente) para password_hash() PHP function. Caso contrário, ocorrerá um erro no login. Novos usuários cadastrados pelo site já terão a criptografia correta.

6. Execute o ngrok. (IMPORTANTE! A URL gerada pelo ngrok é resetada toda vez que o programa é fechado).

   6.1. No terminal do ngrok, configure seu token de autenticação, que pode ser encontrado no seu painel do ngrok:

       ngrok config add-authtoken SEU_TOKEN_AQUI

   6.2. Em seguida, exponha a porta do seu servidor Apache (geralmente a porta 80, indicada no painel do XAMPP):

       ngrok http 80

    6.3. Copie a URL Forwarding gerada (ex: https://xxxx-xxxx.ngrok-free.app) e adicione o caminho para o projeto: https://xxxx-xxxx.ngrok-free.app/GOVacation/govac/.

7. Acesse o painel de desenvolvedor do Mercado Pago e crie uma nova aplicação:

    ![image](https://github.com/user-attachments/assets/82978c08-43f9-41e8-b014-359ade9b037e)

    7.1. Preencha as informações conforme a imagem:

    7.2. Na aba "Contas de Teste", crie uma conta de VENDEDOR e uma de COMPRADOR.

    7.3. Faça login no Mercado Pago com a conta de teste de VENDEDOR.

    7.4. Na conta de teste, vá para "Credenciais de Produção" e copie o Access Token. (IMPORTANTE! Este token será usado no código).

    7.5. Saia da conta de VENDEDOR e faça login com a conta de teste de COMPRADOR. É com esta conta que os pagamentos de teste serão realizados no site.

    7.6. Em uma aba anônima ou outro navegador, faça login com sua conta real do Mercado Pago.

    7.7. Na sua conta real, acesse a aplicação criada, vá para a aba "Webhooks" e configure as notificações. Insira a URL completa do ngrok (https://.../GOVacation/govac/) nos campos "URL para teste" e "URL de produção". Lembre-se de atualizar esta URL sempre que reiniciar o ngrok.

8. Por fim, atualize o código com suas credenciais:

    8.1. Nos arquivos govac/gerar_pagamento.php e govac/confirmar_pagamento.php, insira o Access Token da sua conta de teste de VENDEDOR na variável $accessToken.

    8.2. No arquivo govac/gerar_pagamento.php, atualize as URLs de success, failure e pending com a sua URL base do ngrok, conforme comentado no código. (Lembre-se de fazer isso toda vez que a URL do ngrok mudar).
