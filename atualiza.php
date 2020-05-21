<?php
    include_once 'php/conexao.php';

    class Base {
        public $estacionamentos;
    }
    class Estacionamento
    {
        public $id; //String
        public $lugar; //String
        public $sensor1; //String
        public $sensor2; //String
        public $sensor3; //String
    }

    if (!$conexao) {
        exit;
    }

    $sql = "SELECT * FROM `sensoresNovo`";

    $stmt = mysqli_stmt_init($conexao);

    //checa se é possivel executar declaracao
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit;
    }

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    $output = new Base();
    $output->estacionamentos = array();

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $estacionamento = new Estacionamento();

        $estacionamento->id = $linha['id'];
        $estacionamento->lugar = $linha['lugar'];
        $estacionamento->sensor1 = $linha['sensor1'];
        $estacionamento->sensor2 = $linha['sensor2'];
        $estacionamento->sensor3 = $linha['sensor3'];
        
        $output->estacionamentos[] = $estacionamento;
    }

    header('Content-Type: application/json');
    echo json_encode($output);