<?php

    include('../db/db.php')

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawParadise</title>
    <link rel="shortcut icon" href="../images/logo_redonda.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://kit.fontawesome.com/ec9b9cc810.js" crossorigin="anonymous"></script>
</head>
<body>
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
        <section class="container central">
            <section class="product">
                <?php
                    
                    $id = $_GET["id"];

                    $query = "SELECT * FROM \"products\" WHERE id = '{$id}'";
                    $result = pg_query($query);

                    $rows = pg_num_rows($result);

                    if(isset($_GET['qtd'])){
                        $qtd = $_GET['qtd'];
                    }else{
                        $qtd = 1;
                    }

                    $add = $qtd+1;
                    $remove = $qtd - 1;

                    if($rows > 0) {
                        while($row = pg_fetch_assoc($result)){
                            echo "<div class=\"\"><img src=\"https://http2.mlstatic.com/D_NQ_NP_762012-MLB49226621643_022022-O.webp\" class=\"left-image\"></div>";
                            echo "<div class=\"right\"><div class=\"itens\">";
                            echo "<h3>{$row["product_name"]}</h3>";
                            echo "<p class=\"preco\">R\${$row["product_price"]}</p>";
                            echo "<div class=\"qtd\"><a href=\"./produto.php?id={$row["id"]}&qtd={$remove}\"><i class=\"fa-solid fa-minus\"></i></a><span>{$qtd}</span><a href=\"./produto.php?id={$row["id"]}&qtd={$add}\"><i class=\"fa-solid fa-plus\"></i></a></div>";
                            echo "<br><a class=\"button\" href=\"./carrinho.php?add={$row["id"]}&qtd={$qtd}\">Adicionar ao carrinho</a>";
                            echo "</div></div>";
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