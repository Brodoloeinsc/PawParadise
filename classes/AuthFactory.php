<?php

    class AuthFactory {

        public static function authenticate($email, $senha) {
            // Escapar entradas para evitar injeção SQL
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $senha = filter_var($senha, FILTER_SANITIZE_STRING);

            // Verificação de credenciais no banco de dados
            $query = "SELECT * FROM \"user\" WHERE email = $1 AND password = $2";
            $result = pg_query_params($query, array($email, md5($senha)));

            if (pg_num_rows($result) > 0) {
                // Se as credenciais estiverem corretas, retorna o usuário
                return pg_fetch_assoc($result);
            }
            
            return false;
        }

        public static function setLoginCookie($email) {
            setcookie("email", $email, time() + 3600, "/"); // 1 hora
        }
    }
    
?>
