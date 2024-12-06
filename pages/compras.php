<?php

include("../db/db.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawParadise</title>
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://kit.fontawesome.com/ec9b9cc810.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="nav-search">
            <a href="../index.html" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
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