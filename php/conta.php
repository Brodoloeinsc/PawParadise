<?php
    include("../db/db.php");
    if(!$_COOKIE['email']){
        header('Location: ../pages/login.html');
        exit();
    }

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
</head>
<body>
    <header>
        <nav>
            <a href="../index.html" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
            <a href="../php/plano.php" class="nav-item link">Seu Plano</a>
        </nav>
    </header>
    <section class="all">
        <section class="container central">
            <h1>
                Olá <?php 
                
                    $query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE['email']}'";
                    $result = pg_query($query);

                    $row = pg_fetch_row($result);

                    echo $row[1];
                
                ?>
            </h1>
            <a href="./deslogar.php">Desconectar</a>
        </section>
    </section>
</body>
</html>