<?php
include('../db/db.php');
session_start();
?>

<?php
    include("./header.php");
?>
    <header>
        <nav class="nav-search">
            <div class="carrinho" onclick="redirect()"><i class="fa-solid fa-backward"></i></div>
            <a href="../index.html" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
        </nav>
    </header>
    
    <script>
        function redirect() {
            location.href = "./compras.php";
        }
    </script>

    <section class="all">
        <section class="container central cart">
            <h1>Os itens no seu carrinho são:</h1>

            <section class="cart-itens">
            <?php
                // Inicializa a lista de produtos do carrinho
                $products = isset($_COOKIE["products"]) ? explode(",", $_COOKIE["products"]) : [];

                // Adicionar item ao carrinho
                if (isset($_GET['add'])) {
                    $product_id = $_GET['add'];
                    $quantity = isset($_GET['qtd']) ? intval($_GET['qtd']) : 1;

                    // Quantidade atual do cookie
                    $current_quantity = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 0;

                    // Atualiza a quantidade
                    $new_quantity = $current_quantity + $quantity;

                    // Adiciona ao cookie e atualiza lista de produtos
                    if (!in_array($product_id, $products)) {
                        $products[] = $product_id;
                    }

                    setcookie("products", implode(",", $products), time() + 3600, "/");
                    setcookie($product_id, $new_quantity, time() + 3600, "/");
                    $_COOKIE[$product_id] = $new_quantity; // Atualiza $_COOKIE localmente
                }

                // Remover item do carrinho
                if (isset($_GET['remove'])) {
                    $product_id = $_GET['remove'];

                    // Atualiza quantidade
                    $current_quantity = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 0;
                    $new_quantity = $current_quantity - 1;

                    if ($new_quantity > 0) {
                        // Atualiza a quantidade no cookie
                        setcookie($product_id, $new_quantity, time() + 3600, "/");
                        $_COOKIE[$product_id] = $new_quantity; // Atualiza $_COOKIE localmente
                    } else {
                        // Remove produto da lista e do cookie
                        $products = array_diff($products, [$product_id]);
                        setcookie("products", implode(",", $products), time() + 3600, "/");
                        setcookie($product_id, "", time() - 3600, "/");
                        unset($_COOKIE[$product_id]); // Remove da memória local
                    }

                    if(isset($_GET["all"])){
                        // Remove produto da lista e do cookie
                        $products = array_diff($products, [$product_id]);
                        setcookie("products", implode(",", $products), time() + 3600, "/");
                        setcookie($product_id, "", time() - 3600, "/");
                        unset($_COOKIE[$product_id]); // Remove da memória local
                    }
                }

                // Exibir itens do carrinho
                if (!empty($products)) {
                    foreach ($products as $product_id) {
                        $query = "SELECT * FROM products WHERE id = $1";
                        $stmt = pg_prepare($connection, "fetch_product", $query);
                        $result = pg_execute($connection, "fetch_product", [$product_id]);

                        if ($result && pg_num_rows($result) > 0) {
                            while ($row = pg_fetch_assoc($result)) {
                                // Quantidade atual do produto
                                $qtd = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 1;

                                echo "<article class=\"line\">";
                                echo "<span class=\"nome\">{$row['product_name']}</span>";
                                echo "<span class=\"preco\">R\${$row['product_price']}</span>";
                                echo "<div class=\"qtd\">
                                        <a href=\"./carrinho.php?remove={$product_id}\"><i class=\"fa-solid fa-minus\"></i></a>
                                        <span>{$qtd}</span>
                                        <a href=\"./carrinho.php?add={$product_id}\"><i class=\"fa-solid fa-plus\"></i></a>
                                    </div>";

                                // Botão de excluir
                                echo "<div class=\"delete-btn\">
                                        <a href=\"./carrinho.php?remove={$product_id}&all=\"sim\"\"><button>Excluir</button></a>
                                    </div>";

                                echo "</article>";
                            }
                        }
                    }
                } else {
                    echo 'Nenhum produto adicionado ao carrinho';
                }
            ?>

            </section>

            <section class="end">
                <button>Pagar</button>
            </section>
        </section>
    </section>
    <footer>
        <span>&copy 2024</span>
    </footer>
</body>
</html>
