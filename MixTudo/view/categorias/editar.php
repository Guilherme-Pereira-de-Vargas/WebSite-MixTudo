<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria — MixTudo</title>
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
            $categoria = Categoria::buscar_por_id($id);

            if (!$categoria):
        ?>
            <div class="mensagem erro">❌ <span>Categoria não encontrada.</span></div>
            <a href="listar.php" class="btn btn-secundario">← Voltar para Categorias</a>
        <?php else: ?>

        <div class="breadcrumb">
            <a href="../index.php">Início</a>
            <span class="breadcrumb-sep">›</span>
            <a href="listar.php">Categorias</a>
            <span class="breadcrumb-sep">›</span>
            <span>Editar</span>
        </div>

        <div class="page-header">
            <div>
                <h1>✏️ Editar Categoria</h1>
                <p>Atualize os dados de <strong><?= htmlspecialchars($categoria['nome_categoria']) ?></strong></p>
            </div>
        </div>

        <div class="form-card">
            <form action="../../controller/categoria_controller.php" method="post">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id"   value="<?= $categoria['id_categoria'] ?>">

                <div class="campo">
                    <label for="nome_categoria">Nome da categoria *</label>
                    <input type="text" name="nome_categoria" id="nome_categoria"
                           value="<?= htmlspecialchars($categoria['nome_categoria']) ?>" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao"><?= htmlspecialchars($categoria['descricao']) ?></textarea>
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
