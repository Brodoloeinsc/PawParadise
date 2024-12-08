<?php

    class ProductFactory {

        public static function editProduct($product_id, $product_name, $product_price, $product_image = null) {
            include("../db/db.php");  // Conecta ao banco de dados
        
            // Validação básica dos dados obrigatórios
            if (empty($product_name) || empty($product_price)) {
                throw new Exception("Nome e preço do produto são obrigatórios.");
            }
        
            // Determina a query e o nome da declaração preparada com base na presença da imagem
            if ($product_image) {
                $query = "UPDATE products 
                          SET product_name = $1, product_price = $2, image_url = $3 
                          WHERE id = $4";
                $statement_name = "update_product_with_image";
                pg_prepare($connection, $statement_name, $query);
                $params = [$product_name, $product_price, $product_image, $product_id];
            } else {
                $query = "UPDATE products 
                          SET product_name = $1, product_price = $2 
                          WHERE id = $3";
                $statement_name = "update_product_without_image";
                pg_prepare($connection, $statement_name, $query);
                $params = [$product_name, $product_price, $product_id];
            }
        
            // Executa a consulta usando o nome da declaração preparada
            $result = pg_execute($connection, $statement_name, $params);
        
            // Verifica se a atualização foi bem-sucedida
            if ($result) {
                return true;
            } else {
                throw new Exception("Erro ao editar o produto.");
            }
        }
        

        // Método para adicionar um novo produto ao banco de dados
        public static function addProduct($product_name, $product_price, $product_image) {
            // Conectar ao banco de dados
            include("../db/db.php");

            // Validação básica dos dados
            if (empty($product_name) || empty($product_price) || empty($product_image)) {
                throw new Exception("Todos os campos são obrigatórios.");
            }

            // Prepara a consulta SQL para inserir o produto
            $query = "INSERT INTO products (product_name, product_price, image_url) 
                    VALUES ($1, $2, $3)";
            
            // Prepara a consulta para evitar SQL injection
            $stmt = pg_prepare($connection, "insert_product", $query);

            // Executa a consulta com os dados
            $result = pg_execute($connection, "insert_product", [
                $product_name, 
                $product_price, 
                $product_image
            ]);

            // Verifica se a inserção foi bem-sucedida
            if ($result) {
                return true;
            } else {
                throw new Exception("Erro ao adicionar o produto.");
            }
        }

    }

?>