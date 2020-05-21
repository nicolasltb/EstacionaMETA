<?php

  include('conexao.php');

  $select = "SELECT * FROM sensoresNovo WHERE lugar=`:lugar`";

  $select->bindParam(':lugar',$_GET['lugar']);
  $stmtupdate = $PDO->prepare($select);

  $stmtupdate->execute();
  
  $row = $stmtupdate->fetch(PDO::FETCH_ASSOC);

    

?>
