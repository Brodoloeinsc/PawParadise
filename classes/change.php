<?php

    class User {
        private $connection;
        private $name;
        private $email;
        private $plan;
        private $cep;
        private $street;
        private $city;
        private $state;
        private $complemento;
        private $cellphone;

        public function __construct($connection, $name, $email, $plan, $cep, $street, $city, $state, $complemento = null, $cellphone = null) {
            $this->connection = $connection;
            $this->name = $name;
            $this->email = $email;
            $this->plan = $plan;
            $this->cep = $cep;
            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
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
                        street = COALESCE($5, street),
                        complemento = COALESCE($6, complemento),
                        cellphone = COALESCE($7, cellphone),
                        city = COALESCE($8, city),
                        state = COALESCE($9, state)
                    WHERE email = $2";

            $stmt = pg_prepare($this->connection, "update_user", $query);
            $result = pg_execute($this->connection, "update_user", [
                $this->name, 
                $this->email, 
                $this->plan,
                $this->cep,
                $this->street,
                $this->complemento,
                $this->cellphone,
                $this->city,
                $this->state
            ]);

            // Retorna se a atualização foi bem-sucedida
            return $result ? true : false;
        }
    }

    class Pet {
        private $connection;
        private $petname;
        private $receivedate;
        private $email;

        public function __construct($connection, $petname, $receivedate, $email) {
            $this->connection = $connection;
            $this->petname = $petname;
            $this->receivedate = $receivedate;
            $this->email = $email;
        }

        // Função para atualizar os dados do usuário
        public function updatePetName() {
            // Atualiza os campos fornecidos, preservando os campos não fornecidos
            $query = "UPDATE \"user\" SET 
                        petname = COALESCE($1, petname), 
                        receivedate = COALESCE($2, receivedate) 
                    WHERE email = $3";

            $stmt = pg_prepare($this->connection, "update_pet_name", $query);
            $result = pg_execute($this->connection, "update_pet_name", [
                $this->petname, 
                $this->receivedate, 
                $this->email
            ]);

            // Retorna se a atualização foi bem-sucedida
            return $result ? true : false;
        }
    }

    class UserFactory {

        // Função para criar ou atualizar o usuário
        public static function updateUser($connection, $name, $email, $plan, $cep, $street, $city, $state, $complemento = null, $cellphone = null) {
            // Cria uma instância do usuário
            $user = new User($connection, $name, $email, $plan, $cep, $street, $city, $state, $complemento, $cellphone);
            
            // Chama a função de atualização do usuário
            return $user->updateUser();
        }

        public static function updatePetName($connection, $petname, $receivedate, $email) {
            // Cria uma instância do pet
            $pet = new Pet($connection, $petname, $receivedate, $email);
            
            // Chama a função de atualização do pet
            return $pet->updatePetName();
        }
    }

?>