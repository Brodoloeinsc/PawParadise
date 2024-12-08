<?php

    // Definindo constantes para as URLs e o nome do cookie
    define('LOGIN_PAGE', 'login.php');
    define('SUCESSO_PAGE', 'sucesso.php');
    define('CART_COOKIE', 'products');

    include('../db/db.php');

    if (!$connection) {
        die("Erro de conexão com o banco de dados.");
    }

    // Verifica se o usuário está logado
    function checkLoginStatus() {
        if (!isset($_COOKIE['email'])) {
            redirectTo(LOGIN_PAGE);
        }
    }

    // Obter o user_id a partir do email
    function getUserIdByEmail($connection, $email) {
        $query = "SELECT id FROM \"user\" WHERE email = $1";
        $stmt = pg_prepare($connection, "fetch_user_by_email", $query);
        $result = pg_execute($connection, "fetch_user_by_email", [$email]);

        if ($result && pg_num_rows($result) > 0) {
            return pg_fetch_result($result, 0, 'id'); // Retorna o ID do usuário
        }
        return false; // Caso o usuário não seja encontrado
    }

    // Processa o pagamento, cria o pedido e limpa o carrinho
    function processPayment($connection) {
        // Verifica o login do usuário
        checkLoginStatus();
        
        $email = $_COOKIE['email'];
        
        // Obtém o user_id
        $user_id = getUserIdByEmail($connection, $email);
        if (!$user_id) {
            // Se o usuário não for encontrado
            redirectTo('erro.php');
        }
        
        // Obtém os produtos do carrinho
        $products = isset($_COOKIE[CART_COOKIE]) ? explode(",", $_COOKIE[CART_COOKIE]) : [];
        
        // Calcula o preço total do pedido
        $total_price = calculateTotalPrice($connection, $products);
        
        // Insere o pedido na tabela "orders"
        $order_id = createOrder($connection, $user_id, $total_price);
        
        if ($order_id) {
            // Insere os itens do pedido na tabela "order_items"
            createOrderItems($connection, $order_id, $products);
            
            // Limpa o carrinho (excluindo cookies dos produtos)
            clearCart($products);

            // Redireciona para a página de sucesso
            redirectTo(SUCESSO_PAGE);
        } else {
            // Se houve algum erro ao inserir o pedido
            redirectTo('erro.php');
        }
    }

    // Calcula o preço total do pedido
    function calculateTotalPrice($connection, $products) {
        $total_price = 0;
        foreach ($products as $product_id) {
            $query = "SELECT * FROM products WHERE id = $1";
            $stmt = pg_prepare($connection, "fetch_product", $query);
            $result = pg_execute($connection, "fetch_product", [$product_id]);

            if ($result && pg_num_rows($result) > 0) {
                $row = pg_fetch_assoc($result);
                $qtd = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 1;
                $total_price += $row['product_price'] * $qtd; // Calcula o preço total
            }
        }
        return $total_price;
    }

    // Cria o pedido na tabela "orders"
    function createOrder($connection, $user_id, $total_price) {
        $query = "INSERT INTO \"orders\" (user_id, total_price) VALUES ($1, $2) RETURNING id";
        $stmt = pg_prepare($connection, "insert_order", $query);
        $result = pg_execute($connection, "insert_order", [$user_id, $total_price]);

        if ($result && pg_num_rows($result) > 0) {
            return pg_fetch_result($result, 0, 'id'); // Retorna o ID do pedido gerado
        }
        return false;
    }

    // Cria os itens do pedido na tabela "order_items"
    function createOrderItems($connection, $order_id, $products) {
        foreach ($products as $product_id) {
            // Recupera as informações do produto
            $query = "SELECT * FROM products WHERE id = $1";
            $stmt = pg_prepare($connection, "fetch_product", $query);
            $result = pg_execute($connection, "fetch_product", [$product_id]);

            if ($result && pg_num_rows($result) > 0) {
                $row = pg_fetch_assoc($result);
                $qtd = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 1;
                $price = $row['product_price'];

                // Insere os itens na tabela "order_items"
                $query = "INSERT INTO \"order_items\" (order_id, product_id, quantity, price) 
                        VALUES ($1, $2, $3, $4)";
                $stmt = pg_prepare($connection, "insert_order_item", $query);
                pg_execute($connection, "insert_order_item", [$order_id, $product_id, $qtd, $price]);
            }
        }
    }

    // Limpa o carrinho de compras (remove os cookies)
    function clearCart($products) {
        setcookie(CART_COOKIE, "", time() - 3600, "/");
        foreach ($products as $product_id) {
            setcookie($product_id, "", time() - 3600, "/");
        }
    }

    // Redireciona para a página especificada
    function redirectTo($page) {
        header("Location: $page");
        exit();
    }

    // Processar o pagamento se a requisição for feita (exemplo de chamada via GET)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        processPayment($connection);
    }

    function planUpgrade(){
        
    }
?>
