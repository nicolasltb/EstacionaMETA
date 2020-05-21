<?php
    include_once "conexao.php";
  session_start();
    if(isset($_SESSION['usuarioNome']) ){

      if(!empty($_POST['lugar'])){
        //checa se conexão foi feita com sucesso
        if($conexao){
          $lugar = $_POST['lugar'];
          $sql = "SELECT lugar FROM estacionamentos WHERE lugar=?";
          $stmt = mysqli_stmt_init($conexao);
          //checa se é possivel executar declaracao
          if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$lugar);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            //checa se usuário ja havia sido cadastrado
            if(mysqli_stmt_num_rows($stmt) == 0){
              $sql = "INSERT INTO estacionamentos(dono,lugar) values(?,?)";
              $stmt = mysqli_stmt_init($conexao);
              //checa se é possivel executar declaracao
              if(mysqli_stmt_prepare($stmt,$sql)){
                mysqli_stmt_bind_param($stmt,"ss",$_SESSION['usuarioNome'],$lugar);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php?cadastro=sucesso");
                exit();
              } else {
                header("Location: ../login.php?erro=errosql");
                exit();
            }
          } else {
            header("Location: ../login.php?erro=estacionametojacadastrado");
            exit();
          }
        } else {
          header("Location: ../login.php?erro=errosql");
          exit();
        }
      } else {
        header("Location: ../login.php?erro=erronaconexao");
        exit();
      }
    } else {
      header("Location: ../login.php?erro=preenchatodoscampos");
      exit();
    }
  }
 ?>
