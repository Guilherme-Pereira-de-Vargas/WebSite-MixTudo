function mudar_pagina(pagina) {
    window.location.href = pagina;
}

// Confirmação antes de deletar
function confirmar_delecao(nome) {
    return confirm('Tem certeza que deseja remover "' + nome + '"?\nEsta ação não pode ser desfeita.');
}

// Auto-fechar mensagens após 5 segundos
document.addEventListener('DOMContentLoaded', function () {
    const msgs = document.querySelectorAll('.mensagem');
    msgs.forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(function () { el.remove(); }, 500);
        }, 5000);
    });
});
