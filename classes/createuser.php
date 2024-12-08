<?php

    class UserFactory {

        public static function createUser($email, $nome, $senha) {
            // Verificando se o email já está cadastrado
            $query = "SELECT * FROM \"user\" WHERE email = $1";
            $result = pg_query_params($query, array($email));

            if (pg_num_rows($result) > 0) {
                throw new Exception("Email já existente");
            }

            // Gerando o ID único para o novo usuário
            $id = uniqid();

            // Criando o hash da senha de forma segura
            $hashedPassword = PasswordFactory::createHashedPassword($senha);

            // Inserindo o novo usuário no banco de dados
            $insertQuery = "INSERT INTO \"user\" (id, name, email, password, plan) VALUES ($1, $2, $3, $4, $5)";
            $insertResult = pg_query_params($insertQuery, array($id, $nome, $email, $hashedPassword, '0'));

            if (!$insertResult) {
                throw new Exception("Erro ao cadastrar usuário");
            }

            return new User($id, $nome, $email, $hashedPassword);
        }
    }

    class PasswordFactory {

        public static function createHashedPassword($senha) {
            if (empty($senha)) {
                throw new Exception("Senha não pode ser vazia");
            }
            
            // Gerando o hash da senha
            return password_hash($senha, PASSWORD_DEFAULT);
        }

        public static function verifyPassword($inputPassword, $storedPassword) {
            return password_verify($inputPassword, $storedPassword);
        }
    }

    class User {
        private $id;
        private $name;
        private $email;
        private $password;

        public function __construct($id, $name, $email, $password) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }
    }

?>