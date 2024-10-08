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
        </nav>
    </header>
    <section class="center">
        <section class="container central">
            <div class="erro">
                <?php
                
                if(isset($_GET['error'])){
                    echo$_GET['error']."!";
                }
                
                ?>
            </div>
            <form action="../php/criarconta.php" method="post" class="login">
                <label>Nome</label> <br>
                <input type="text" name="nome"><br>
                <label>Email</label> <br>
                <input type="text" name="email"><br>
                <label>Senha</label> <br>
                <input type="password" name="password"><br>
                <input type="submit" value="Criar Conta">
                <a href="./login.html">Já tenho uma conta</a>
            </form>
        </section>
    </section>
</body>
</html>