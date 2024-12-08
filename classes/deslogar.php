<?php

    class Deslogar {
        // Remove o cookie de autenticação
        public static function logoutCookie($cookieName) {
            setcookie($cookieName, '', time() - 3600, '/'); // Expira o cookie
        }

        // Destroi a sessão do usuário
        public static function logoutSession() {
            session_unset();
            session_destroy();
        }

        // Redireciona para a página especificada
        public static function redirectTo($location) {
            header("Location: $location");
            exit();
        }
    }

?>