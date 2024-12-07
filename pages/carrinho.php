<?php
include('../db/db.php');
session_start();

include('../classes/cart.php');

include("./header.php");
?>
<header>
    <nav class="nav-search">
        <div class="carrinho" onclick="redirect()"><i class="fa-solid fa-arrow-left"></i> Voltar</div>
        <a href="../index.php" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
    </nav>
</header>

<script>
    function redirect() {
        location.href = "./compras.php"; // Redireciona para a página de compras/carrinho
    }
</script>

<section class="all">
    <section class="container central cart">
        <h1>Os itens no seu carrinho são:</h1>

        <section class="cart-itens">
        <?php
            // Instanciando o carrinho com o Factory
            $cart = CartFactory::createCart();

            // Lógica de adição de produtos
            if (isset($_GET['add'])) {
                $product_id = $_GET['add'];
                $quantity = isset($_GET['qtd']) ? intval($_GET['qtd']) : 1;
                $cart->addProduct($product_id, $quantity);
            }

            // Lógica de remoção de produtos
            if (isset($_GET['remove'])) {
                $product_id = $_GET['remove'];
                $all = isset($_GET["all"]) ? true : false;
                $cart->removeProduct($product_id, $all);
            }

            // Exibir os itens do carrinho
            $cart->displayCart($connection);
        ?>
        </section>

        <section class="end">
            <a href="pagamento.php">Pagar</a>
        </section>
    </section>
</section>

<footer>
    <span>&copy 2024</span>
</footer>
</body>
</html>
