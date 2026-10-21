<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixTudo Variedades</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/script.js" defer></script>
</head>
<body>

    <!-- ── NAVBAR ─────────────────────────────────────────────────── -->
    <nav class="navbar">
        <a class="navbar-logo" href="index.php">🛒 Mix<span>Tudo</span></a>
        <ul class="navbar-nav">
            <li><a href="index.php" class="ativo"><span class="icone">🏠</span> Início</a></li>
            <li><a href="clientes/listar.php"><span class="icone">👥</span> Clientes</a></li>
            <li><a href="produtos/listar.php"><span class="icone">📦</span> Produtos</a></li>
            <li><a href="categorias/listar.php"><span class="icone">🏷️</span> Categorias</a></li>
        </ul>
    </nav>

    <main>

        <?php
            require_once '../model/mensagens.php';
            $msg = getMensagem();
            if ($msg):
        ?>
            <div class="mensagem <?= $msg['tipo'] ?>">
                <?= $msg['tipo'] === 'sucesso' ? '✅' : '❌' ?>
                <span><?= $msg['texto'] ?></span>
            </div>
        <?php endif; ?>

        <!-- ── HERO ──────────────────────────────────────────────── -->
        <div class="hero">
            <div>
                <h1>Bem-vindo ao MixTudo</h1>
                <p>Sistema de gerenciamento de loja — controle clientes, produtos e categorias.</p>
            </div>
            <div class="hero-emoji">🛍️</div>
        </div>

        <!-- ── MENU CARDS ─────────────────────────────────────────── -->
        <div class="page-header">
            <div>
                <h1>Menu Principal</h1>
                <p>Selecione uma área para gerenciar</p>
            </div>
        </div>

        <div class="cards-grid">
            <a class="card-menu" href="clientes/listar.php">
                <div class="card-icone">👥</div>
                <h2>Clientes</h2>
                <p>Cadastrar, consultar, editar e remover clientes da loja.</p>
            </a>

            <a class="card-menu" href="produtos/listar.php">
                <div class="card-icone">📦</div>
                <h2>Produtos</h2>
                <p>Gerenciar o catálogo de produtos e controle de estoque.</p>
            </a>

            <a class="card-menu" href="categorias/listar.php">
                <div class="card-icone">🏷️</div>
                <h2>Categorias</h2>
                <p>Organizar produtos por categorias e descrições.</p>
            </a>
        </div>

    </main>

    <footer>
        &copy; <?= date('Y') ?> MixTudo Variedades — Sistema de Gestão
    </footer>

</body>
</html>
