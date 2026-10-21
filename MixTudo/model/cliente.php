<?php

    require_once __DIR__ . '/../config/database.php';

    class Cliente {

        public static function buscar_todos() {
            global $conexao;
            $sql = "SELECT * FROM cliente ORDER BY nome";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
        }

        public static function buscar_por_id($id) {
            global $conexao;
            $id = intval($id);
            $sql = "SELECT * FROM cliente WHERE id_cliente = $id";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_assoc() : null;
        }

        public static function cadastrar($nome, $cpf, $telefone, $email, $endereco) {
            global $conexao;
            $nome     = $conexao->real_escape_string($nome);
            $cpf      = $conexao->real_escape_string($cpf);
            $telefone = $conexao->real_escape_string($telefone);
            $email    = $conexao->real_escape_string($email);
            $endereco = $conexao->real_escape_string($endereco);
            $sql = "INSERT INTO cliente (nome, cpf, telefone, email, endereco)
                    VALUES ('$nome','$cpf','$telefone','$email','$endereco')";
            return $conexao->query($sql);
        }

        public static function atualizar($id, $nome, $cpf, $telefone, $email, $endereco) {
            global $conexao;
            $id       = intval($id);
            $nome     = $conexao->real_escape_string($nome);
            $cpf      = $conexao->real_escape_string($cpf);
            $telefone = $conexao->real_escape_string($telefone);
            $email    = $conexao->real_escape_string($email);
            $endereco = $conexao->real_escape_string($endereco);
            $sql = "UPDATE cliente SET nome='$nome', cpf='$cpf', telefone='$telefone',
                    email='$email', endereco='$endereco' WHERE id_cliente=$id";
            return $conexao->query($sql);
        }

        public static function deletar($id) {
            global $conexao;
            $id = intval($id);
            $sql = "DELETE FROM cliente WHERE id_cliente = $id";
            return $conexao->query($sql);
        }
    }

?>
