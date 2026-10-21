<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos — MixTudo</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="../js/script.js" defer></script>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-logo" href="../index.php">🛒 Mix<span>Tudo</span></a>
        <ul class="navbar-nav">
            <li><a href="../index.php"><span class="icone">🏠</span> Início</a></li>
            <li><a href="../clientes/listar.php"><span class="icone">👥</span> Clientes</a></li>
            <li><a href="listar.php" class="ativo"><span class="icone">📦</span> Produtos</a></li>
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
            <span>Produtos</span>
        </div>

        <div class="page-header">
            <div>
                <h1>📦 Produtos</h1>
                <p>Catálogo de produtos da loja</p>
            </div>
            <a class="btn btn-primario" href="adicionar.php">＋ Novo Produto</a>
        </div>

        <div class="tabela-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Cód. Barras</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../../model/produto.php';
                    $produtos = Produto::buscar_todos();

                    if (empty($produtos)):
                ?>
                    <tr>
                        <td colspan="7" class="tabela-vazia">
                            <span class="vazia-icone">📦</span>
                            Nenhum produto cadastrado ainda.<br>
                            <a href="adicionar.php" class="btn btn-primario" style="margin-top:14px; display:inline-flex;">＋ Cadastrar primeiro produto</a>
                        </td>
                    </tr>
                <?php else: foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id_produto']) ?></td>
                        <td><strong><?= htmlspecialchars($p['nome_produto']) ?></strong>
                            <?php if (!empty($p['descricao'])): ?>
                                <br><small style="color:#9ca3af"><?= htmlspecialchars(mb_strimwidth($p['descricao'], 0, 50, '…')) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($p['nome_categoria'])): ?>
                                <span class="badge badge-azul"><?= htmlspecialchars($p['nome_categoria']) ?></span>
                            <?php else: ?>
                                <span class="badge badge-cinza">—</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>R$ <?= number_format($p['preco'], 2, ',', '.') ?></strong></td>
                        <td>
                            <?php
                                $qtd = intval($p['quantidade_estoque']);
                                $cls = $qtd > 10 ? 'badge-verde' : ($qtd > 0 ? 'badge-azul' : 'badge-cinza');
                            ?>
                            <span class="badge <?= $cls ?>"><?= $qtd ?> un.</span>
                        </td>
                        <td><?= htmlspecialchars($p['codigo_barras'] ?: '—') ?></td>
                        <td>
                            <div class="btn-acoes">
                                <a class="btn btn-editar" href="editar.php?id=<?= $p['id_produto'] ?>">✏️ Editar</a>
                                <form method="post" action="../../controller/produto_controller.php"
                                      onsubmit="return confirmar_delecao('<?= htmlspecialchars($p['nome_produto'], ENT_QUOTES) ?>')">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="id"   value="<?= $p['id_produto'] ?>">
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
