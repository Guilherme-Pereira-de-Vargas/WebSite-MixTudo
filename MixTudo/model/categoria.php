<?php

    require_once __DIR__ . '/../config/database.php';

    class Categoria {

        public static function buscar_todas() {
            global $conexao;
            $sql = "SELECT * FROM categoria ORDER BY nome_categoria";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
        }

        public static function buscar_por_id($id) {
            global $conexao;
            $id = intval($id);
            $sql = "SELECT * FROM categoria WHERE id_categoria = $id";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_assoc() : null;
        }

        public static function cadastrar($nome, $descricao) {
            global $conexao;
            $nome      = $conexao->real_escape_string($nome);
            $descricao = $conexao->real_escape_string($descricao);
            $sql = "INSERT INTO categoria (nome_categoria, descricao) VALUES ('$nome','$descricao')";
            return $conexao->query($sql);
        }

        public static function atualizar($id, $nome, $descricao) {
            global $conexao;
            $id        = intval($id);
            $nome      = $conexao->real_escape_string($nome);
            $descricao = $conexao->real_escape_string($descricao);
            $sql = "UPDATE categoria SET nome_categoria='$nome', descricao='$descricao' WHERE id_categoria=$id";
            return $conexao->query($sql);
        }

        public static function deletar($id) {
            global $conexao;
            $id = intval($id);
            $sql = "DELETE FROM categoria WHERE id_categoria = $id";
            return $conexao->query($sql);
        }
    }

?>
