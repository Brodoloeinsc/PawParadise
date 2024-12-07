<?php
session_start();
?>

<?php include('./header.php'); ?>
<style>
    body{
        width: 100%;
    }
    /* Container para centralizar horizontal e verticalmente */
    .container {
        display: flex;
        justify-content: center; /
        align-items: center; 
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        height: 70vh;
        text-align: center;
        width: 100%; 
        margin: 0;
    }

    /* Estilizando o conteúdo dentro da container */
    .sucesso {
        margin: 0 auto;
        max-width: 600px; 
        width: 100%; 
        padding: 20px;
        background-color: #f4f4f4; 
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }

    .buttons a {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #066437;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .buttons a:hover {
        background-color: #054a2a;
    }
</style>

<div class="container sucesso">
    <h1>Pagamento realizado com sucesso!</h1>
    <p>Seu pagamento foi processado com sucesso. Em breve, você receberá as novidades da PawParadise!</p>
    <div class="buttons">
        <a href="../index.php">Voltar para a página inicial</a>
    </div>
</div>
</body>
</html>
