<?php
class BancoDeDados {
  var $NomeServerBD;
  var $UsuarioBD;
  var $SenhaDB;


  public function __construct($NomeServerBD){
    $this->NomeServerBD = $NomeServerBD;
  }
  public function setUsuario($UsuarioBD){
    $this->UsuarioBD = $UsuarioBD;
  }
  public function setSenha($SenhaDB){
    $this->SenhaDB = $SenhaDB;
  }

  public function conectar($NomeDB){
    return mysqli_connect($this->NomeServerBD,$this->UsuarioBD,$this->SenhaDB,$NomeDB);
  }

}

 ?>
