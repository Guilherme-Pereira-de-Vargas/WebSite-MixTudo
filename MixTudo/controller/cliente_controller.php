<?php

    require_once __DIR__ . '/../model/cliente.php';
    require_once __DIR__ . '/../model/mensagens.php';

    $acao = $_POST['acao'] ?? '';

    // ── CADASTRAR ────────────────────────────────────────────────────────────
    if ($acao === 'cadastrar') {
        $nome     = trim($_POST['nome']     ?? '');
        $cpf      = trim($_POST['cpf']      ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email    = trim($_POST['email']    ?? '');
        $endereco = trim($_POST['endereco'] ?? '');

        $erros = [];

        if (empty($nome))     $erros[] = "Nome é obrigatório.";
        if (empty($cpf))      $erros[] = "CPF é obrigatório.";
        if (empty($telefone)) $erros[] = "Telefone é obrigatório.";
        if (empty($email))    $erros[] = "E-mail é obrigatório.";
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/clientes/adicionar.php");
            exit;
        }

        Cliente::cadastrar($nome, $cpf, $telefone, $email, $endereco);
        setMensagem('sucesso', "Cliente <strong>$nome</strong> cadastrado com sucesso!");
        header("Location: ../view/clientes/listar.php");
        exit;
    }

    // ── EDITAR ───────────────────────────────────────────────────────────────
    if ($acao === 'editar') {
        $id       = intval($_POST['id']       ?? 0);
        $nome     = trim($_POST['nome']       ?? '');
        $cpf      = trim($_POST['cpf']        ?? '');
        $telefone = trim($_POST['telefone']   ?? '');
        $email    = trim($_POST['email']      ?? '');
        $endereco = trim($_POST['endereco']   ?? '');

        $erros = [];
        if (empty($nome))     $erros[] = "Nome é obrigatório.";
        if (empty($cpf))      $erros[] = "CPF é obrigatório.";
        if (empty($telefone)) $erros[] = "Telefone é obrigatório.";
        if (empty($email))    $erros[] = "E-mail é obrigatório.";
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";

        if (!empty($erros)) {
            setMensagem('erro', implode('<br>', $erros));
            header("Location: ../view/clientes/editar.php?id=$id");
            exit;
        }

        Cliente::atualizar($id, $nome, $cpf, $telefone, $email, $endereco);
        setMensagem('sucesso', "Cliente atualizado com sucesso!");
        header("Location: ../view/clientes/listar.php");
        exit;
    }

    // ── DELETAR ──────────────────────────────────────────────────────────────
    if ($acao === 'deletar') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            Cliente::deletar($id);
            setMensagem('sucesso', "Cliente removido com sucesso!");
        } else {
            setMensagem('erro', "ID inválido.");
        }
        header("Location: ../view/clientes/listar.php");
        exit;
    }

    header("Location: ../view/index.php");
    exit;

?>
