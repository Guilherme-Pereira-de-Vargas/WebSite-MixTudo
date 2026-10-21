<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto — MixTudo</title>
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
            require_once '../../model/categoria.php';

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
            <a href="listar.php">Produtos</a>
            <span class="breadcrumb-sep">›</span>
            <span>Novo Produto</span>
        </div>

        <div class="page-header">
            <div>
                <h1>📦 Novo Produto</h1>
                <p>Preencha os dados para cadastrar um produto</p>
            </div>
        </div>

        <div class="form-card">
            <form action="../../controller/produto_controller.php" method="post">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="campo">
                    <label for="nome_produto">Nome do produto *</label>
                    <input type="text" name="nome_produto" id="nome_produto"
                           placeholder="Ex: Caneta Azul BIC" required>
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao"
                              placeholder="Descrição opcional do produto"></textarea>
                </div>

                <div class="campo">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" name="preco" id="preco"
                           step="0.01" min="0" placeholder="0,00" required>
                </div>

                <div class="campo">
                    <label for="quantidade_estoque">Quantidade em estoque *</label>
                    <input type="number" name="quantidade_estoque" id="quantidade_estoque"
                           min="0" placeholder="0" required>
                </div>

                <div class="campo">
                    <label for="codigo_barras">Código de barras</label>
                    <input type="text" name="codigo_barras" id="codigo_barras"
                           placeholder="Ex: 7891234567890">
                </div>

                <div class="campo">
                    <label for="id_categoria">Categoria *</label>
                    <select name="id_categoria" id="id_categoria" required>
                        <option value="">— Selecione uma categoria —</option>
                        <?php
                            $categorias = Categoria::buscar_todas();
                            foreach ($categorias as $cat):
                        ?>
                            <option value="<?= $cat['id_categoria'] ?>">
                                <?= htmlspecialchars($cat['nome_categoria']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (empty($categorias)): ?>
                        <small style="color:var(--cor-aviso); margin-top:6px; display:block;">
                            ⚠️ Nenhuma categoria cadastrada.
                            <a href="../categorias/adicionar.php">Cadastrar agora</a>
                        </small>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primario">✅ Cadastrar</button>
                    <a href="listar.php" class="btn btn-secundario">← Voltar</a>
                </div>
            </form>
        </div>

    </main>

    <footer>&copy; <?= date('Y') ?> MixTudo Variedades</footer>

</body>
</html>
