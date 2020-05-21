<?php

    $HOST = "localhost";
    $BANCO = "u535349949_dados";
    $USUARIO = "u535349949_root";
    $SENHA = "Estacionamento0000";

    $conexao = mysqli_connect($HOST,$USUARIO,$SENHA,$BANCO);
      try {
        $PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);
      } catch (PDOException $e) {
        echo "Erro de conexao, detalhes: " . $e->getMessage();
      }

