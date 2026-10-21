<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes — MixTudo</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="../js/script.js" defer></script>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-logo" href="../index.php">🛒 Mix<span>Tudo</span></a>
        <ul class="navbar-nav">
            <li><a href="../index.php"><span class="icone">🏠</span> Início</a></li>
            <li><a href="listar.php" class="ativo"><span class="icone">👥</span> Clientes</a></li>
            <li><a href="../produtos/listar.php"><span class="icone">📦</span> Produtos</a></li>
            <li><a href="../categorias/listar.php"><span class="icone">🏷️</span> Categorias</a></li>
        </ul>
    </nav>

    <main>

        <?php
            require_once '../../model/mensagens.php';
            $msg = getMensagem();
            if ($msg):
        ?>
            <div class="mensagem <?= $msg['tipo'] ?>">
                <?= $msg['tipo'] === 'sucesso' ? '✅' : '❌' ?>
                <span><?= $msg['texto'] ?></span>
            </div>
        <?php endif; ?>

        <div class="breadcrumb">
            <a href="../index.php">Início</a>
            <span class="breadcrumb-sep">›</span>
            <span>Clientes</span>
        </div>

        <div class="page-header">
            <div>
                <h1>👥 Clientes</h1>
                <p>Lista de todos os clientes cadastrados</p>
            </div>
            <a class="btn btn-primario" href="adicionar.php">＋ Novo Cliente</a>
        </div>

        <div class="tabela-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../../model/cliente.php';
                    $clientes = Cliente::buscar_todos();

                    if (empty($clientes)):
                ?>
                    <tr>
                        <td colspan="7" class="tabela-vazia">
                            <span class="vazia-icone">👥</span>
                            Nenhum cliente cadastrado ainda.<br>
                            <a href="adicionar.php" class="btn btn-primario" style="margin-top:14px; display:inline-flex;">＋ Cadastrar primeiro cliente</a>
                        </td>
                    </tr>
                <?php else: foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['id_cliente']) ?></td>
                        <td><strong><?= htmlspecialchars($c['nome']) ?></strong></td>
                        <td><?= htmlspecialchars($c['cpf']) ?></td>
                        <td><?= htmlspecialchars($c['telefone']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['endereco']) ?></td>
                        <td>
                            <div class="btn-acoes">
                                <a class="btn btn-editar" href="editar.php?id=<?= $c['id_cliente'] ?>">✏️ Editar</a>
                                <form method="post" action="../../controller/cliente_controller.php"
                                      onsubmit="return confirmar_delecao('<?= htmlspecialchars($c['nome'], ENT_QUOTES) ?>')">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="id"   value="<?= $c['id_cliente'] ?>">
                                    <button type="submit" class="btn btn-deletar">🗑️ Remover</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

    </main>

    <footer>&copy; <?= date('Y') ?> MixTudo Variedades</footer>

</body>
</html>
