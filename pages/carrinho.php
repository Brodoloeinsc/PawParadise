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
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
                <article class="line">
                    <span class="nome">Bolinha</span>
                    <span class="preco">R$60,00</span>
                </article>
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