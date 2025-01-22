<?php
    session_start();
    include("../db/db.php");
    if (!$_COOKIE['email']) {
        header('Location: ../index.php');
        exit();
    }

    // Recupera os dados do usuário
    $query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE['email']}'";
    $result = pg_query($query);
    $row = pg_fetch_assoc($result); // Usando pg_fetch_assoc para acessar os campos por nome
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
    <style>
        body {
            font-family: 'Gochi Hand', cursive;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
        }

        .container h1 {
            display: inline-block; /* Permite que o texto fique na mesma linha */
            margin: 0; /* Remove margens externas para alinhar perfeitamente */
            font-size: 24px;
            color: #2c6b3f;
        }

        .deslogar {
            display: inline-block;
            margin-left: 15px;
            background-color: #066437;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .deslogar:hover {
            background-color: #0a8f50; 
            color: #f9f9f9;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 18px;
            text-align: left;
            color: #333;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #066437;
            color: white;
            border: 0;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            width: 100%;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0a8f50; 
            color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="../index.php" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
            <a href="../php/plano.php" class="nav-item link">Seu Plano</a>
        </nav>
    </header>

    <section class="all">
        <section class="container central">
            <div>
                <h1>Olá, <?php echo $row['name']; ?>!</h1>
                <a href="./deslogar.php" class="deslogar">Desconectar</a>
                <?php
                
                    if($row['admin'] == true){
                        echo "<a href=\"../admin/index.php\" class=\"deslogar\">Admin Panel</a>";
                    }

                ?>
            </div>
            <form action="atualizar_dados.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>

                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">

                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" value="<?php echo $row['cep']; ?>" onkeyup="viacep()">

                <label for="street">Rua:</label>
                <input type="text" id="street" name="street" value="<?php echo $row['street']; ?>" readonly>

                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento" value="<?php echo $row['complemento']; ?>">

                <label for="city">Cidade:</label>
                <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>"readonly>

                <label for="state">Estado:</label>
                <input type="text" id="state" name="state" value="<?php echo $row['state']; ?>"readonly>

                <label for="cellphone">Celular:</label>
                <input type="text" id="cellphone" name="cellphone" value="<?php echo $row['cellphone']; ?>">

                <button type="submit" class="btn">Atualizar Dados</button>
                
            </form>
        </section>
    </section>

    <script>
        function viacep() {
            const cepInput = document.getElementById('cep');
            if (cepInput.value.length === 8) {
                const cep = cepInput.value;

                async function fetchAddress(param) {
                    try {
                        const res = await fetch(`https://viacep.com.br/ws/${param}/json/`);
                        const data = await res.json();
                        if (data.erro) {
                            alert("CEP não encontrado!");
                        } else {
                            console.log(data);
                            document.getElementById('street').value = data.logradouro || '';
                            document.getElementById('city').value = data.localidade || '';
                            document.getElementById('state').value = data.uf || '';    
                        }
                    } catch (error) {
                        alert("Erro ao buscar o endereço:", error);
                    }
                }
                
                fetchAddress(cep);
            }
        }
    </script>
</body>
</html>
