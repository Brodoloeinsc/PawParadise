<?php
    include('../db/db.php');
    session_start();

    // Verifica se o usuário está logado (caso contrário, redireciona para o login)
    if (!isset($_COOKIE['email'])) {
        header("Location: login.php");
        exit();
    }

    // Inicializa o carrinho e o total
    $products = isset($_COOKIE["products"]) ? explode(",", $_COOKIE["products"]) : [];
    $total = 0; // Variável para armazenar o total do carrinho
?>

<?php include('./header.php') ?>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin-top: 50px;
        flex-direction: column;
    }

    /* Estilizando o botão de voltar */
    .back-button {
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 20px;
        color: #000;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .back-button a {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
    }

    .back-button a:hover {
        color: #066437;
    }

    .back-button i {
        margin-right: 5px;
    }

    /* Estilo da área de pagamento */
    .pagamento {
        text-align: center;
        margin-top: 20px;
        width: 100%;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .pagamento h1 {
        margin-bottom: 0px;
    }

    .pagamento label {
        display: block;
        margin: 8px 0;
        font-weight: bold;
    }

    .pagamento input[type="text"],
    .pagamento input[type="month"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .pagamento input[type="submit"] {
        padding: 10px 20px;
        background-color: #066437;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .pagamento input[type="submit"]:hover {
        background-color: #054d28;
    }

    /* Estilo do resumo do carrinho */
    .resumo-carrinho {
        width: 100%;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .resumo-carrinho h3 {
        margin-bottom: 15px;
    }

    .resumo-carrinho .produto {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .resumo-carrinho .total {
        font-weight: bold;
        font-size: 18px;
    }
</style>

<div class="back-button">
    <a href="carrinho.php"><i class="fa-solid fa-arrow-left"></i> Voltar ao Carrinho</a>
</div>

<div class="container pagamento">
    <h1>Finalize o pagamento</h1>

    <!-- Resumo do carrinho -->
    <div class="resumo-carrinho">
        <h3>Resumo do carrinho</h3>
        <?php
        if (!empty($products)) {
            foreach ($products as $product_id) {
                // Consulta para pegar os dados do produto
                $query = "SELECT * FROM products WHERE id = $1"; // Uso de parâmetro
                $stmt = pg_prepare($connection, "fetch_product_" . $product_id, $query);
                $result = pg_execute($connection, "fetch_product_" . $product_id, [$product_id]);

                if ($result && pg_num_rows($result) > 0) {
                    while ($row = pg_fetch_assoc($result)) {
                        $qtd = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 1;
                        $total += $row['product_price'] * $qtd; // Atualiza o total do carrinho

                        echo "<div class=\"produto\">";
                        echo "<span>{$row['product_name']} (x{$qtd})</span>";
                        echo "<span>R\${$row['product_price']}</span>";
                        echo "</div>";
                    }
                }
            }
        } else {
            echo 'Nenhum produto adicionado ao carrinho';
        }
        ?>
        <div class="total">
            Total a pagar: R$ <?php echo number_format($total, 2, ',', '.'); ?>
        </div>
    </div>

    <form action="./processar_pagamento.php" method="post">
        <label for="cartao">Número do Cartão</label>
        <input type="text" name="cartao" id="cartao" required>

        <label for="data_expiracao">Data de Expiração</label>
        <input type="month" name="data_expiracao" id="data_expiracao" required>

        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" maxlength="3" pattern="\d{3}" required oninput="this.value=this.value.replace(/[^\d]/g,'');">

        <input type="submit" value="Pagar">
    </form>
</div>

</body>
</html>