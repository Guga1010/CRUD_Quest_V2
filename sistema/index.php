<?php
    include_once("templates/header.php");
?>

    <main class="main">

        <section class="options">

            <div class="options__container">
                <button class="option-btn" onclick="window.location.href='inserirTema.php'">Adicionar Tema</button>
            </div>

            <div class="options__container">
                <button class="option-btn" onclick="window.location.href='excluirTema.php'">Excluir Tema</button>
            </div>

            <div class="options__container">
                <button class="option-btn" onclick="window.location.href='inserirPergunta.php'">Adicionar Pergunta</button>
            </div>

            <div class="options__container">
                <button class="option-btn" onclick="window.location.href='excluirPergunta.php'">Remover Pergunta</button>
            </div>

            <div class="options__container">
                <button class="option-btn" onclick="window.location.href='alterarPergunta.php'">Atualizar Pergunta/Alternativa</button>
            </div>

        </section>

    </main>

<?php
    include_once("templates/footer.php");   
?>