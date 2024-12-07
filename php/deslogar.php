<?php
    session_start();
    include('../classes/deslogar.php');

    // Realiza o logout
    Deslogar::logoutCookie('email');
    Deslogar::logoutSession();

    // Redireciona para a página de conta após o logout
    Deslogar::redirectTo('./conta.php');

?>
