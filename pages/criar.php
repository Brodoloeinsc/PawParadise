<?php
    include("./header.php");
?>
    <header>
        <nav>
            <a href="../index.php" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
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
                <input class="submit" type="submit" value="Criar Conta">
                <a href="../index.html">Já tenho uma conta</a>
            </form>
        </section>
    </section>
</body>
</html>