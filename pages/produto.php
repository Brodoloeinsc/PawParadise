<?php
    include('../db/db.php');
?>

<?php
    include("./header.php");
?>
<header>
    <nav class="nav-search">
        <div class="carrinho" onclick="redirect()"><i class="fa-solid fa-arrow-left"></i> Voltar</div>
        <a href="../index.php" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
        <div class="carrinho" onclick="redirectCart()"><i class="fa-solid fa-cart-shopping"></i></div>
    </nav>
</header>

<script>
    function redirect() {
        location.href = "./compras.php";
    }

    function redirectCart() {
        location.href = "./carrinho.php";
    }
</script>

<section class="all">
    <section class="container central">
        <section class="product">
            <?php
                $id = $_GET["id"];

                $query = "SELECT * FROM \"products\" WHERE id = '{$id}'";
                $result = pg_query($query);

                $rows = pg_num_rows($result);

                if(isset($_GET['qtd'])){
                    $qtd = $_GET['qtd'];
                } else {
                    $qtd = 1;
                }

                $add = $qtd + 1;
                $remove = $qtd - 1;

                if($rows > 0) {
                    while($row = pg_fetch_assoc($result)){
                        echo "<div class=\"left-image\"><img src=\"{$row["image_url"]}\" alt=\"Imagem do produto\"></div>";
                        echo "<div class=\"right\">";
                        echo "<div class=\"itens\">";
                        echo "<h3>{$row["product_name"]}</h3>";
                        echo "<p class=\"preco\">R\${$row["product_price"]}</p>";
                        echo "<div class=\"qtd\"><a href=\"./produto.php?id={$row["id"]}&qtd={$remove}\"><i class=\"fa-solid fa-minus\"></i></a><span>{$qtd}</span><a href=\"./produto.php?id={$row["id"]}&qtd={$add}\"><i class=\"fa-solid fa-plus\"></i></a></div>";
                        echo "<br><a class=\"button\" href=\"./carrinho.php?add={$row["id"]}&qtd={$qtd}\">Adicionar ao carrinho</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </section>
    </section>
</section>

<footer>
    <span>&copy 2024</span>
</footer>
</body>
</html>
