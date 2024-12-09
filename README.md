# Paw Paradise

A Paw Paradise é uma empresa fictícia criada para um trabalho integrado de empreendedorismo, análise de sistemas e programação web.

A empresa consiste em uma plataforma de venda de produtos para cachorro e assinatura de um plano mensal que dá direito a produtos para cachorro de forma personalizada.

## Planos de Assinatura
A Paw Paradise oferece os seguintes planos de assinatura:

- **Básico**: 1 produto simples por mês.
- **Regular**: 2 produtos simples por mês.
- **Premium**: 1 produto simples por mês e 1 produto especial por mês.
- **Ultra**: 2 produtos simples por mês e 2 produtos especiais por mês.

## Páginas da Plataforma
A plataforma será dividida em algumas páginas, cada uma com funcionalidades específicas:

- **Página Principal**: Exibe redirecionamentos para outras seções.
- **Scroll de Produtos**: Exibe os produtos disponíveis para compra.
- **Info Sobre o Plano**: Detalha os planos de assinatura.
- **Sobre a Conta**: Exibe informações da conta do usuário.
- **Carrinho de Compras**: Exibe os itens adicionados ao carrinho.
- **Página de Pagamento**: Permite ao usuário finalizar a compra.
- **Criar Conta**: Formulário para criar uma nova conta.
- **Login**: Tela para o usuário logar na plataforma.

## Tecnologias Usadas para o Desenvolvimento

- **Frontend**:
    - HTML
    - CSS
    - Javascript

- **Backend**:
    - PHP/Node

- **Banco de Dados**:
    - PostgreSQL

- **Ferramentas de Desenvolvimento**:
    - Git/Github
    - Docker

## Como Rodar o Código

Para rodar o código, siga os passos abaixo:

1. Entre na pasta do projeto e, no terminal, execute o seguinte comando:
   ```bash
   docker-compose up -d
   ```

2. Entre em algum visualizador de banco de dados, como DBeaver ou DataGrip.

3. Execute os seguintes comandos para criar as tabelas no banco de dados:

```sql
    CREATE TABLE "user" (
        id SERIAL PRIMARY KEY,                          -- Identificador único, auto incremento
        name varchar(255) NOT NULL,                     -- Nome do usuário
        email varchar(255) UNIQUE NOT NULL,             -- Email do usuário, único e não nulo
        password varchar(255) NOT NULL,                 -- Senha do usuário
        plan varchar(255) NOT NULL,                     -- Plano do usuário (Básico, Regular, Premium, Ultra)
        cep varchar(10) NOT NULL,                       -- CEP do endereço
        address varchar(255) NOT NULL,                  -- Endereço do usuário
        complemento varchar(255),                       -- Complemento do endereço
        cellphone varchar(15),                          -- Número de celular (aceita DDD e número)
        admin boolean,                                  -- Verificador de admin
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Data de criação do usuário
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Data de atualização do usuário
    );

    CREATE TABLE "products" (
        id SERIAL PRIMARY KEY,              -- Identificador único, auto incremento
        product_name VARCHAR(255) NOT NULL,  -- Nome do produto, não nulo
        product_price DECIMAL(10, 2) NOT NULL, -- Preço do produto, com duas casas decimais
        image_url TEXT
    );

    CREATE TABLE "orders" (
        id serial PRIMARY KEY,               -- Identificador único do pedido
        user_id int,                         -- Identificador do usuário (FK)
        total_price decimal,                 -- Preço total do pedido
        order_date timestamp default current_timestamp, -- Data do pedido
        FOREIGN KEY (user_id) REFERENCES "user"(id) -- Chave estrangeira para a tabela de usuários
    );

    CREATE TABLE "order_items" (
        order_id int,                        -- Identificador do pedido (FK)
        product_id int,                      -- Identificador do produto (FK)
        quantity int,                        -- Quantidade do produto no pedido
        price decimal,                       -- Preço do produto no momento do pedido
        PRIMARY KEY (order_id, product_id),  -- Chave composta para garantir a unicidade do par pedido-produto
        FOREIGN KEY (order_id) REFERENCES "orders"(id) ON DELETE CASCADE, -- Relacionamento com a tabela de pedidos
        FOREIGN KEY (product_id) REFERENCES "products"(id) ON DELETE CASCADE -- Relacionamento com a tabela de produtos
    );

    INSERT INTO "user" (name, email, password, plan, cep, address, complemento, cellphone, admin) 
    VALUES
    ('Carlos Medina', 'carlos@exemplo.com', MD5('senha123'), 'Premium', '12345-678', 'Rua Exemplo, 123', 'Apto 101', '(11) 91234-5678', true),
    ('Nilton Souza', 'nilton@exemplo.com', MD5('senha123'), 'Básico', '12345-678', 'Rua Principal, 456', 'Casa 2', '(35) 99876-5432', false),
    ('Ana Costa', 'ana@exemplo.com', MD5('senha123'), 'Regular', '23456-789', 'Avenida Central, 789', 'Bloco B', '(21) 98765-4321', false),
    ('Roberta Lima', 'roberta@exemplo.com', MD5('senha123'), 'Ultra', '34567-890', 'Rua das Flores, 101', '', '(31) 92345-6789', false),
    ('João Silva', 'joao@exemplo.com', MD5('senha123'), 'Premium', '45678-901', 'Rua Nova, 202', 'Apto 302', '(61) 93456-7890', false);

```

## Para acessar o site como admin

Login:
- carlos@exemplo.com
- senha123

## Contribuindo para o Projeto

Agradecemos seu interesse em contribuir para o projeto! Para garantir que todos possam colaborar de forma eficiente e organizada, siga as etapas abaixo:

### Passos para Contribuição

1. **Fork do Repositório**
   - Primeiramente, faça um fork deste repositório para a sua conta do GitHub.
   - No GitHub, acesse a página principal do repositório e clique no botão "Fork" no canto superior direito.

2. **Clone o Repositório**
   - Clone o repositório forkado para o seu computador:
     ```bash
     git clone https://github.com/seu-usuario/paw-paradise.git
     ```

3. **Criação de uma Nova Branch**
   - Crie uma nova branch para a sua feature ou correção de bug:
     ```bash
     git checkout -b nome-da-feature
     ```

4. **Realize as Modificações**
   - Faça as alterações necessárias no código ou adicione novas funcionalidades.

5. **Adicione as Alterações ao Commit**
   - Após realizar as modificações, adicione os arquivos ao staging:
     ```bash
     git add .
     ```

6. **Commit das Alterações**
   - Comite suas alterações com uma mensagem clara e concisa:
     ```bash
     git commit -m "Descrição do que foi alterado ou adicionado"
     ```

7. **Envie para o Repositório Remoto**
   - Envie a branch com suas alterações para o repositório remoto:
     ```bash
     git push origin nome-da-feature
     ```

8. **Abra um Pull Request**
   - Acesse a página do seu repositório forkado no GitHub e clique no botão "Compare & Pull Request".
   - Descreva o que foi alterado e explique o propósito da modificação.

9. **Revisão e Merge**
   - Após a revisão do código e aprovação do pull request, suas alterações serão integradas ao repositório principal.

### Guidelines para Contribuição

- **Mensagens de Commit**: As mensagens de commit devem ser claras e descritivas sobre as alterações feitas.
- **Padrão de Código**: Tente seguir o padrão de código utilizado no projeto, incluindo a formatação e a organização dos arquivos.
- **Testes**: Sempre que possível, adicione testes para as novas funcionalidades ou correções.
- **Documentação**: Atualize o README ou qualquer documentação relevante sempre que adicionar uma nova funcionalidade ou fizer mudanças significativas.

### Problemas e Sugestões

Se você encontrar um bug ou tiver uma sugestão de melhoria, abra uma **issue** na seção de problemas do repositório. Isso ajuda a manter o projeto organizado e facilita a colaboração.

Agradecemos sua contribuição e esperamos que aproveite a experiência de colaborar com o projeto Paw Paradise!

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
