<?php

    // Definindo constantes para as URLs
    define('LOGIN_PAGE', 'login.php');
    define('SUCESSO_PAGE', 'sucesso.php');
    define('CART_COOKIE', 'products');

    class PaymentProcessor {
        // Verifica se o usuário está logado
        public static function checkLoginStatus() {
            if (!isset($_COOKIE['email'])) {
                self::redirectTo(LOGIN_PAGE);
            }
        }

        // Processa o pagamento e limpa os produtos do carrinho
        public static function processPayment() {

            // Exclui o cookie "products" (Carrinho de compras)
            setcookie(CART_COOKIE, "", time() - 3600, "/");

            // Exclui os cookies individuais dos produtos
            if (isset($_COOKIE[CART_COOKIE])) {
                $products = explode(",", $_COOKIE[CART_COOKIE]);
                foreach ($products as $product_id) {
                    setcookie($product_id, "", time() - 3600, "/");
                }
            }

            // Redireciona para a página de sucesso
            self::redirectTo(SUCESSO_PAGE);
        }

        // Redireciona para a página especificada
        public static function redirectTo($page) {
            header("Location: $page");
            exit();
        }
    }

?>