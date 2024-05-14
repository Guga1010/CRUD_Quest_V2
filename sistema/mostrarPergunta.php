<?php
    include_once("templates/header.php");
?>

<?php

    include "connection.php";

    $sqlPergunta = "SELECT * FROM pergunta";
    $resSqlPergunta = $db->query($sqlPergunta);

    while($dadosPergunta = $resSqlPergunta->fetchArray())
    {
        echo "<p>$dadosPergunta[0] - $dadosPergunta[1] </p>";
        echo "<p>Tema: $dadosPergunta[2] (MODIFICAR SQL)</p>";
        echo "<p>Alternativas: $dadosPergunta[3] (MODIFICAR SQL)</p>";
    }

?>

<main>
    
</main>
        
<?php
    include_once("templates/footer.php");   
?>