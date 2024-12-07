<?php

    class User {
        private $connection;
        private $name;
        private $email;
        private $plan;
        private $cep;
        private $address;
        private $complemento;
        private $cellphone;

        public function __construct($connection, $name, $email, $plan, $cep, $address, $complemento = null, $cellphone = null) {
            $this->connection = $connection;
            $this->name = $name;
            $this->email = $email;
            $this->plan = $plan;
            $this->cep = $cep;
            $this->address = $address;
            $this->complemento = $complemento;
            $this->cellphone = $cellphone;
        }

        // Função para atualizar os dados do usuário
        public function updateUser() {
            // Atualiza os campos fornecidos, preservando os campos não fornecidos
            $query = "UPDATE \"user\" SET 
                        name = COALESCE($1, name), 
                        email = COALESCE($2, email), 
                        plan = COALESCE($3, plan),
                        cep = COALESCE($4, cep),
                        address = COALESCE($5, address),
                        complemento = COALESCE($6, complemento),
                        cellphone = COALESCE($7, cellphone)
                    WHERE email = $2";

            $stmt = pg_prepare($this->connection, "update_user", $query);
            $result = pg_execute($this->connection, "update_user", [
                $this->name, 
                $this->email, 
                $this->plan,
                $this->cep,
                $this->address,
                $this->complemento,
                $this->cellphone
            ]);

            // Retorna se a atualização foi bem-sucedida
            return $result ? true : false;
        }
    }



    class UserFactory {

        // Função para criar ou atualizar o usuário
        public static function updateUser($connection, $name, $email, $plan, $cep, $address, $complemento = null, $cellphone = null) {
            // Cria uma instância do usuário
            $user = new User($connection, $name, $email, $plan, $cep, $address, $complemento, $cellphone);
            
            // Chama a função de atualização do usuário
            return $user->updateUser();
        }
    }

?>