<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente — MixTudo</title>
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
            <a href="listar.php">Clientes</a>
            <span class="breadcrumb-sep">›</span>
            <span>Novo Cliente</span>
        </div>

        <div class="page-header">
            <div>
                <h1>👤 Novo Cliente</h1>
                <p>Preencha os dados para cadastrar um cliente</p>
            </div>
        </div>

        <div class="form-card">
            <form action="../../controller/cliente_controller.php" method="post">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="campo">
                    <label for="nome">Nome completo *</label>
                    <input type="text" name="nome" id="nome" placeholder="Ex: João da Silva" required>
                </div>

                <div class="campo">
                    <label for="cpf">CPF *</label>
                    <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required>
                </div>

                <div class="campo">
                    <label for="telefone">Telefone *</label>
                    <input type="tel" name="telefone" id="telefone" placeholder="(48) 99999-0000" required>
                </div>

                <div class="campo">
                    <label for="email">E-mail *</label>
                    <input type="email" name="email" id="email" placeholder="cliente@email.com" required>
                </div>

                <div class="campo">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" placeholder="Rua, número, bairro, cidade">
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
