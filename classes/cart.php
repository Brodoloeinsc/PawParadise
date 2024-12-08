<?php

    class CartFactory {
        public static function createCart() {
            return new Cart();
        }
    }

    class Cart {
        private $products = [];

        public function __construct() {
            // Inicializa a lista de produtos do carrinho
            $this->products = isset($_COOKIE["products"]) ? explode(",", $_COOKIE["products"]) : [];
        }

        // Adicionar item ao carrinho
        public function addProduct($product_id, $quantity = 1) {
            $current_quantity = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 0;
            $new_quantity = $current_quantity + $quantity;

            // Atualiza os cookies e a lista de produtos
            if (!in_array($product_id, $this->products)) {
                $this->products[] = $product_id;
            }

            setcookie("products", implode(",", $this->products), time() + 3600, "/");
            setcookie($product_id, $new_quantity, time() + 3600, "/");
            $_COOKIE[$product_id] = $new_quantity; // Atualiza $_COOKIE localmente
        }

        // Remover item do carrinho
        public function removeProduct($product_id, $all = false) {
            $current_quantity = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 0;

            if ($all || $current_quantity <= 1) {
                // Remove produto da lista e do cookie
                $this->products = array_diff($this->products, [$product_id]);
                setcookie("products", implode(",", $this->products), time() + 3600, "/");
                setcookie($product_id, "", time() - 3600, "/");
                unset($_COOKIE[$product_id]); // Remove da memória local
            } else {
                // Atualiza a quantidade no cookie
                $new_quantity = $current_quantity - 1;
                setcookie($product_id, $new_quantity, time() + 3600, "/");
                $_COOKIE[$product_id] = $new_quantity; // Atualiza $_COOKIE localmente
            }
        }

        // Exibir itens do carrinho
        public function displayCart($connection) {
            if (!empty($this->products)) {
                foreach ($this->products as $product_id) {
                    $query = "SELECT * FROM products WHERE id = $1";
                    $stmt = pg_prepare($connection, "fetch_{$product_id}", $query);
                    $result = pg_execute($connection, "fetch_{$product_id}", [$product_id]);

                    if ($result && pg_num_rows($result) > 0) {
                        while ($row = pg_fetch_assoc($result)) {
                            $qtd = isset($_COOKIE[$product_id]) ? intval($_COOKIE[$product_id]) : 1;
                            echo "<article class=\"line\">";
                            echo "<span class=\"nome\">{$row['product_name']}</span>";
                            echo "<span class=\"preco\">R\${$row['product_price']}</span>";
                            echo "<div class=\"qtd\">
                                    <a href=\"./carrinho.php?remove={$product_id}\"><i class=\"fa-solid fa-minus\"></i></a>
                                    <span>{$qtd}</span>
                                    <a href=\"./carrinho.php?add={$product_id}\"><i class=\"fa-solid fa-plus\"></i></a>
                                </div>";

                            echo "<div class=\"delete-btn\">
                                    <a href=\"./carrinho.php?remove={$product_id}&all=sim\"><button>Excluir</button></a>
                                </div>";

                            echo "</article>";
                        }
                    }
                }
            } else {
                echo 'Nenhum produto adicionado ao carrinho';
            }
        }
    }


?>