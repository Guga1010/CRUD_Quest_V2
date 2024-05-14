<?php

    $db = new SQLite3('../BD_Quest.db');

    if(!$db)
    {
        die("Não foi possível conectar ao banco de dados.");
    }

?>