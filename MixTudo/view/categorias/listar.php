<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias — MixTudo</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="../js/script.js" defer></script>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-logo" href="../index.php">🛒 Mix<span>Tudo</span></a>
        <ul class="navbar-nav">
            <li><a href="../index.php"><span class="icone">🏠</span> Início</a></li>
            <li><a href="../clientes/listar.php"><span class="icone">👥</span> Clientes</a></li>
            <li><a href="../produtos/listar.php"><span class="icone">📦</span> Produtos</a></li>
            <li><a href="listar.php" class="ativo"><span class="icone">🏷️</span> Categorias</a></li>
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
            <span>Categorias</span>
        </div>

        <div class="page-header">
            <div>
                <h1>🏷️ Categorias</h1>
                <p>Categorias para organização dos produtos</p>
            </div>
            <a class="btn btn-primario" href="adicionar.php">＋ Nova Categoria</a>
        </div>

        <div class="tabela-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome da Categoria</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../../model/categoria.php';
                    $categorias = Categoria::buscar_todas();

                    if (empty($categorias)):
                ?>
                    <tr>
                        <td colspan="4" class="tabela-vazia">
                            <span class="vazia-icone">🏷️</span>
                            Nenhuma categoria cadastrada ainda.<br>
                            <a href="adicionar.php" class="btn btn-primario" style="margin-top:14px; display:inline-flex;">＋ Cadastrar primeira categoria</a>
                        </td>
                    </tr>
                <?php else: foreach ($categorias as $cat): ?>
                    <tr>
                        <td><?= htmlspecialchars($cat['id_categoria']) ?></td>
                        <td><strong><?= htmlspecialchars($cat['nome_categoria']) ?></strong></td>
                        <td><?= htmlspecialchars($cat['descricao'] ?: '—') ?></td>
                        <td>
                            <div class="btn-acoes">
                                <a class="btn btn-editar" href="editar.php?id=<?= $cat['id_categoria'] ?>">✏️ Editar</a>
                                <form method="post" action="../../controller/categoria_controller.php"
                                      onsubmit="return confirmar_delecao('<?= htmlspecialchars($cat['nome_categoria'], ENT_QUOTES) ?>')">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="id"   value="<?= $cat['id_categoria'] ?>">
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
