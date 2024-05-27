<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php

    $codigoPergunta = $_GET['codigo'];

    include "connection.php";
    $sqlAlternativas = "SELECT desc_pergunta, correta_alternativa, errada_alternativa1, errada_alternativa2, errada_alternativa3 
    FROM pergunta
    INNER JOIN alternativa ON pergunta.id_pergunta = alternativa.id_alternativa 
    WHERE id_pergunta = $codigoPergunta";

    $resSqlAlternativas = $db->query($sqlAlternativas);
    $dadosAlternativa = $resSqlAlternativas->fetchArray();

    echo "<div class='topo-popup'>
            <a id='fechar-popup' onclick='fecharPopup()'>X</a>
        </div>
        ";

    echo "<div class='tabela-titulo'>
            <table cellspacing='0'>
                <thead>
                    <tr>
                        <th>Descrição da pergunta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$dadosAlternativa[0]</td>
                    </tr>
                </tbody>
            </table>
        </div>";

        echo "<div class='tabela-alternativas'>
                <table cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Alternativa Correta</th><th>Alternativa Incorreta 1</th><th>Alternativa Incorreta 2</th>
                            <th>Alternativa Incorreta 3</th>
                        </tr>
                    </thead>  
                    <tbody>";
                    echo "<tr>";
                        echo "<td>$dadosAlternativa[1]</td>";
                        echo "<td>$dadosAlternativa[2]</td>";
                        echo "<td>$dadosAlternativa[3]</td>";
                        echo "<td>$dadosAlternativa[4]</td>";
                    echo "</tr>";

            echo " </tbody>
            </table>
            </div>";

    ?>
</body>
</html>