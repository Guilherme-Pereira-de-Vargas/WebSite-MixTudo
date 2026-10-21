<?php

    require_once __DIR__ . '/../config/database.php';

    class Produto {

        public static function buscar_todos() {
            global $conexao;
            $sql = "SELECT p.*, c.nome_categoria FROM produto p
                    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                    ORDER BY p.nome_produto";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
        }

        public static function buscar_por_id($id) {
            global $conexao;
            $id = intval($id);
            $sql = "SELECT * FROM produto WHERE id_produto = $id";
            $resultado = $conexao->query($sql);
            return $resultado ? $resultado->fetch_assoc() : null;
        }

        public static function cadastrar($nome, $descricao, $preco, $quantidade, $codigo_barras, $id_categoria) {
            global $conexao;
            $nome          = $conexao->real_escape_string($nome);
            $descricao     = $conexao->real_escape_string($descricao);
            $preco         = floatval($preco);
            $quantidade    = intval($quantidade);
            $codigo_barras = $conexao->real_escape_string($codigo_barras);
            $id_categoria  = intval($id_categoria);
            $sql = "INSERT INTO produto (nome_produto, descricao, preco, quantidade_estoque, codigo_barras, id_categoria)
                    VALUES ('$nome','$descricao',$preco,$quantidade,'$codigo_barras',$id_categoria)";
            return $conexao->query($sql);
        }

        public static function atualizar($id, $nome, $descricao, $preco, $quantidade, $codigo_barras, $id_categoria) {
            global $conexao;
            $id            = intval($id);
            $nome          = $conexao->real_escape_string($nome);
            $descricao     = $conexao->real_escape_string($descricao);
            $preco         = floatval($preco);
            $quantidade    = intval($quantidade);
            $codigo_barras = $conexao->real_escape_string($codigo_barras);
            $id_categoria  = intval($id_categoria);
            $sql = "UPDATE produto SET nome_produto='$nome', descricao='$descricao', preco=$preco,
                    quantidade_estoque=$quantidade, codigo_barras='$codigo_barras', id_categoria=$id_categoria
                    WHERE id_produto=$id";
            return $conexao->query($sql);
        }

        public static function deletar($id) {
            global $conexao;
            $id = intval($id);
            $sql = "DELETE FROM produto WHERE id_produto = $id";
            return $conexao->query($sql);
        }
    }

?>
