# Paw Paradise

A Paw Paradise e uma empresa ficticia criada para um trabalho integrado de empreendedorismo, analise de sistemas e programaçao web.

A empresa consiste em uma plataforma de venda de produtos para cachorro e assinatura de um plano mensal que da direito a produtos para cachorro de forma personalizada.

Os planos de assinatura sao:
- Basico (1 produto simples por mes)
- Regular (2 produtos simples por mes)
- Premium (1 produto simples por mes e 1 produto especial por mes)
- Ultra (2 produto simples por mes e 2 produto especial por mes)

A plataforma sera dividida em algumas paginas:
- Principal com dois redirecionamentos
- Scroll de produtos
- Info sobre o plano
- Sobre a conta
- Carrinho de compras
- Pagina de Pagamento
- Criar Conta
- Logar na sua conta

Tecnologias usadas para o desenvolvimento:
- HTML
- CSS
- PostgreSQL
- PHP/Node
- Javascript
- Git/Github
- Docker

Para rodar o codigo faça os seguintes passos: <br><br>
``` Entre na pasta e de no terminal docker compose up -d ```<br><br>
``` Entre em algum visualizador de db para acessar o banco DBeaver, DataGrip ```<br><br>
``` Digite os seguintes codigos de criaçao de tabelas ```<br><br>
``` CREATE TABLE "user" (id varchar(255) NOT NULL unique, name varchar(255), email varchar(255) unique, password varchar(255), plan varchar(255)); ```<br><br>