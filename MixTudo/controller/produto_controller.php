<?php

    require_once __DIR__ . '/../model/produto.php';
    require_once __DIR__ . '/../model/mensagens.php';

    $acao = $_POST['acao'] ?? '';

    // ── CADASTRAR ────────────────────────────────────────────────────────────
    if ($acao === 'cadastrar') {
        $nome          = trim($_POST['nome_produto']      ?? '');
        $descricao     = trim($_POST['descricao']         ?? '');
        $preco         = trim($_POST['preco']             ?? '');
        $quantidade    = trim($_POST['quantidade_estoque'] ?? '');
        $codigo_barras = trim($_POST['codigo_barras']     ?? '');
        $id_categoria  = intval($_POST['id_categoria']    ?? 0);

        $erros = [];
        if (empty($nome))       $erros[] = "Nome do produto é obrigatório.";
        if (empty($preco))      $erros[] = "Preço é obrigatório.";
        elseif (!is_numeric($preco) || floatval($preco) < 0) $erros[] = "Preço inválido.";
        if ($quantidade === '')  $erros[] = "Quantidade em estoque é obrigatória.";
        elseif (!is_numeric($quantidade) || intval($quantidade) < 0) $erros[] = "Quantidade inválida.";
        if ($id_categoria <= 0) $erros[] = "Selecione uma categoria.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/produtos/adicionar.php");
            exit;
        }

        Produto::cadastrar($nome, $descricao, $preco, $quantidade, $codigo_barras, $id_categoria);
        setMensagem('sucesso', "Produto <strong>$nome</strong> cadastrado com sucesso!");
        header("Location: ../view/produtos/listar.php");
        exit;
    }

    // ── EDITAR ───────────────────────────────────────────────────────────────
    if ($acao === 'editar') {
        $id            = intval($_POST['id']               ?? 0);
        $nome          = trim($_POST['nome_produto']       ?? '');
        $descricao     = trim($_POST['descricao']          ?? '');
        $preco         = trim($_POST['preco']              ?? '');
        $quantidade    = trim($_POST['quantidade_estoque']  ?? '');
        $codigo_barras = trim($_POST['codigo_barras']      ?? '');
        $id_categoria  = intval($_POST['id_categoria']     ?? 0);

        $erros = [];
        if (empty($nome))       $erros[] = "Nome do produto é obrigatório.";
        if (empty($preco))      $erros[] = "Preço é obrigatório.";
        elseif (!is_numeric($preco) || floatval($preco) < 0) $erros[] = "Preço inválido.";
        if ($quantidade === '')  $erros[] = "Quantidade em estoque é obrigatória.";
        elseif (!is_numeric($quantidade) || intval($quantidade) < 0) $erros[] = "Quantidade inválida.";
        if ($id_categoria <= 0) $erros[] = "Selecione uma categoria.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/produtos/editar.php?id=$id");
            exit;
        }

        Produto::atualizar($id, $nome, $descricao, $preco, $quantidade, $codigo_barras, $id_categoria);
        setMensagem('sucesso', "Produto atualizado com sucesso!");
        header("Location: ../view/produtos/listar.php");
        exit;
    }

    // ── DELETAR ──────────────────────────────────────────────────────────────
    if ($acao === 'deletar') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            Produto::deletar($id);
            setMensagem('sucesso', "Produto removido com sucesso!");
        } else {
            setMensagem('erro', "ID inválido.");
        }
        header("Location: ../view/produtos/listar.php");
        exit;
    }

    header("Location: ../view/index.php");
    exit;

?>
