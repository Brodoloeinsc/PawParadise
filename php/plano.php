<?php
session_start();
include("../db/db.php");
if(!$_COOKIE['email']){
    header('Location: ../index.php');
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
    <style>
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
            <a href="./conta.php" class="nav-item link">Sua Conta</a>
        </nav>
    </header>
    
    <?php
        // Recupera o plano atual do usuário
        $query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE['email']}'";
        $result = pg_query($query);
        $row = pg_fetch_assoc($result);
        $seuplano = $row["plan"];
    ?>

    <section class="all">
        <section class="container lateral left">
            <?php
                // Carrega o JSON com os planos
                $plans = json_decode(file_get_contents('../js/plans.json'), true);

                echo '<h1>Planos:</h1>';

                for ($i = 0; $i < count($plans); $i++) {
                    $plan = $plans[$i];
                    $id = $i + 1; // ID do plano começa em 1
                    echo "<article class=\"card planos\">";
                    echo "<h3>{$plan['name']}</h3>";
                    echo "<p class=\"preco\">{$plan['price']}</p>";
                    if ($seuplano == $id) {
                        echo "<p>(O Seu)</p>";
                    } else {
                        echo "<a href=\"upgrade.php?plano=$id\"><button>Upgrade</button></a>";
                    }
                    echo "</article>";
                }
            ?>
        </section>

        <section class="container central">
            <h1>Seu Plano</h1>
            <section class="informacao">
                <span>Seu plano hoje é <?php
                    switch ($row["plan"]){
                        case 0:
                            echo "sem";
                            break;
                        case 1:
                            echo "o basico de";
                            break;
                        case 2:
                            echo "o regular de";
                            break;
                        case 3:
                            echo "o premium de";
                            break;
                        case 4:
                            echo "o ultra de";
                            break;
                    }
                ?> assinatura</span>
                <form action="dados_pet.php" method="POST">
                    <input id ="email" name="email" type="hidden" value="<?php echo $row['email']; ?>">
                    
                    <label for="petname">Nome do Pet:</label>
                    <input type="text" id="petname" name="petname" value="<?php echo $row['petname']; ?>">

                    <label for="receivedate">Data de Recebimento:</label>
                    <input type="date" id="receivedate" name="receivedate" value="<?php echo $row['receivedate']; ?>">

                    <button type="submit" class="btn">Atualizar Dados</button>
                </form>
            </section>
        </section>

        <section class="container lateral right">
        <?php
                // Carrega o JSON com os planos
                $plans = json_decode(file_get_contents('../js/plans.json'), true);

                echo '<h1>Planos:</h1>';

                for ($i = 0; $i < count($plans); $i++) {
                    $plan = $plans[$i];
                    $id = $i + 1; // ID do plano começa em 1
                    echo "<article class=\"card planos\">";
                    echo "<h3>{$plan['name']}</h3>";
                    echo "<p class=\"preco\">{$plan['price']}</p>";
                    if ($seuplano == $id) {
                        echo "<p>(O Seu)</p>";
                    } else {
                        echo "<a href=\"upgrade.php?plano=$id\"><button>Upgrade</button></a>";
                    }
                    echo "</article>";
                }
            ?>
        </section>
    </section>

    <footer>
        <span>&copy 2024</span>
    </footer>
</body>
</html>
