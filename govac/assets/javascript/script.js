document.addEventListener('DOMContentLoaded', function() {
    // Esconde todas as seções de conteúdo
    function hideAllSections() {
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
    }

    // Remove a classe 'active' de todos os links do menu
    function deactivateAllMenuLinks() {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
    }

    // Mostra a seção de nova locação por padrão
    document.getElementById('new-rental-content').style.display = 'block';

    // Event listeners para os links do menu
    document.getElementById('new-rental-link').addEventListener('click', function(e) {
        e.preventDefault();
        hideAllSections();
        deactivateAllMenuLinks();
        this.classList.add('active');
        document.getElementById('new-rental-content').style.display = 'block';
    });

    document.getElementById('edit-rental-link').addEventListener('click', function(e) {
        e.preventDefault();
        hideAllSections();
        deactivateAllMenuLinks();
        this.classList.add('active');
        document.getElementById('edit-rental-content').style.display = 'block';
    });

    // Confirmação para exclusão
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir esta locação?')) {
                e.preventDefault();
            }
        });
    });
});