<?php

include("../db/db.php");

?>

<?php
    include("./header.php");
?>
    <header>
        <nav class="nav-search">
            <a href="../index.php" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
            <div class="carrinho" onclick="redirect()"><i class="fa-solid fa-cart-shopping"></i></div>
        </nav>
    </header>
    
    <script>
        function redirect() {
            location.href = "./carrinho.php";
        }
    </script>

    <section class="all">
        <section class="container central">
            <?php
            
                $query = "SELECT * FROM \"products\"";
                $result = pg_query($query);

                $rows = pg_num_rows($result);

                if($rows > 0) {
                    while($row = pg_fetch_assoc($result)){
                        echo "<article class=\"card compras\">";
                        echo "<img src=\"https://http2.mlstatic.com/D_NQ_NP_762012-MLB49226621643_022022-O.webp\">";
                        echo "<h3>{$row["product_name"]}</h3>";
                        echo "<p class=\"preco\">R\${$row["product_price"]}</p>";
                        echo "<a class=\"button\" href=\"./produto.php?id={$row["id"]}\">Comprar</a>";
                        echo "</article>";
                    }
                }

            ?>
        </section>
    </section>
    
    <footer>
        <span>&copy 2024</span>
    </footer>
</body>
</html>