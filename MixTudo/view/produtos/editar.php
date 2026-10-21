<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto — MixTudo</title>
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
            require_once '../../model/produto.php';
            require_once '../../model/categoria.php';

            $msg = getMensagem();
            if ($msg):
        ?>
            <div class="mensagem <?= $msg['tipo'] ?>">
                <?= $msg['tipo'] === 'sucesso' ? '✅' : '❌' ?>
                <span><?= $msg['texto'] ?></span>
            </div>
        <?php endif; ?>

        <?php
            $id = intval($_GET['id'] ?? 0);
            $produto = Produto::buscar_por_id($id);

            if (!$produto):
        ?>
            <div class="mensagem erro">❌ <span>Produto não encontrado.</span></div>
            <a href="listar.php" class="btn btn-secundario">← Voltar para Produtos</a>
        <?php else: ?>

        <div class="breadcrumb">
            <a href="../index.php">Início</a>
            <span class="breadcrumb-sep">›</span>
            <a href="listar.php">Produtos</a>
            <span class="breadcrumb-sep">›</span>
            <span>Editar</span>
        </div>

        <div class="page-header">
            <div>
                <h1>✏️ Editar Produto</h1>
                <p>Atualize os dados de <strong><?= htmlspecialchars($produto['nome_produto']) ?></strong></p>
            </div>
        </div>

        <div class="form-card">
            <form action="../../controller/produto_controller.php" method="post">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id"   value="<?= $produto['id_produto'] ?>">

                <div class="campo">
                    <label for="nome_produto">Nome do produto *</label>
                    <input type="text" name="nome_produto" id="nome_produto"
                           value="<?= htmlspecialchars($produto['nome_produto']) ?>" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea>
                </div>

                <div class="campo">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" name="preco" id="preco" step="0.01" min="0"
                           value="<?= $produto['preco'] ?>" required>
                </div>

                <div class="campo">
                    <label for="quantidade_estoque">Quantidade em estoque *</label>
                    <input type="number" name="quantidade_estoque" id="quantidade_estoque" min="0"
                           value="<?= $produto['quantidade_estoque'] ?>" required>
                </div>

                <div class="campo">
                    <label for="codigo_barras">Código de barras</label>
                    <input type="text" name="codigo_barras" id="codigo_barras"
                           value="<?= htmlspecialchars($produto['codigo_barras']) ?>">
                </div>

                <div class="campo">
                    <label for="id_categoria">Categoria *</label>
                    <select name="id_categoria" id="id_categoria" required>
                        <option value="">— Selecione —</option>
                        <?php
                            $categorias = Categoria::buscar_todas();
                            foreach ($categorias as $cat):
                                $sel = ($cat['id_categoria'] == $produto['id_categoria']) ? 'selected' : '';
                        ?>
                            <option value="<?= $cat['id_categoria'] ?>" <?= $sel ?>>
                                <?= htmlspecialchars($cat['nome_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primario">💾 Salvar Alterações</button>
                    <a href="listar.php" class="btn btn-secundario">← Voltar</a>
                </div>
            </form>
        </div>

        <?php endif; ?>

    </main>

    <footer>&copy; <?= date('Y') ?> MixTudo Variedades</footer>

</body>
</html>
