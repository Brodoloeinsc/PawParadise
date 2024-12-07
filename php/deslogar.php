<?php
session_start();

// Remover o cookie "email"
setcookie('email', '', time() - 3600, '/'); // Expirando o cookie

// Destruir a sessão
session_unset();
session_destroy();

// Redirecionar para a página inicial após o logout
header("Location: ./conta.php");
exit();
?>
