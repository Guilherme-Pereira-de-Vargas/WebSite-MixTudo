<?php

    require_once __DIR__ . '/../model/categoria.php';
    require_once __DIR__ . '/../model/mensagens.php';

    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar') {
        $nome      = trim($_POST['nome_categoria'] ?? '');
        $descricao = trim($_POST['descricao']      ?? '');

        $erros = [];
        if (empty($nome)) $erros[] = "Nome da categoria é obrigatório.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/categorias/adicionar.php");
            exit;
        }

        Categoria::cadastrar($nome, $descricao);
        setMensagem('sucesso', "Categoria <strong>$nome</strong> cadastrada com sucesso!");
        header("Location: ../view/categorias/listar.php");
        exit;
    }

    if ($acao === 'editar') {
        $id        = intval($_POST['id']           ?? 0);
        $nome      = trim($_POST['nome_categoria'] ?? '');
        $descricao = trim($_POST['descricao']      ?? '');

        $erros = [];
        if (empty($nome)) $erros[] = "Nome da categoria é obrigatório.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/categorias/editar.php?id=$id");
            exit;
        }

        Categoria::atualizar($id, $nome, $descricao);
        setMensagem('sucesso', "Categoria atualizada com sucesso!");
        header("Location: ../view/categorias/listar.php");
        exit;
    }

    if ($acao === 'deletar') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            Categoria::deletar($id);
            setMensagem('sucesso', "Categoria removida com sucesso!");
        } else {
            setMensagem('erro', "ID inválido.");
        }
        header("Location: ../view/categorias/listar.php");
        exit;
    }

    header("Location: ../view/index.php");
    exit;

?>
