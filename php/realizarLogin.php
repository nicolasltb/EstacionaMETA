<?php
include_once 'conexao.php';
if(isset($_POST['logar'])){
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  if(!empty($usuario)&&!empty($senha)){


    //checa se conexão foi feita com sucesso
    if($conexao){
      $sql = "SELECT * FROM usuarios WHERE email=? OR nome = ?;";
      $stmt = mysqli_stmt_init($conexao);
      if(mysqli_stmt_prepare($stmt,$sql)) {
        mysqli_stmt_bind_param($stmt,"ss",$usuario,$usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if($linha = mysqli_fetch_assoc($resultado)){
          if(password_verify($senha,$linha['senha']) ){
            session_start();
            $_SESSION['usuarioID'] = $linha['id'];
            $_SESSION['usuarioNome'] = $linha['nome'];
            header("Location: ../login.php?login=sucesso)");
            exit();
          } else {
            header("Location: ../login.php?error=senhaerrada&usuario=".$usuario);
            exit();
          }
        } header("Location: ../login.php?error=usuarionaocadastrado");
        exit();
      } else {
        header("Location: ../login.php?error=errosql&usuario=".$usuario);
        exit();
      }
    } else {
      header("Location: ../login.php?error=erronaconexao&usuario=".$usuario);
      exit();
    }
  } else {
    header("Location: ../login.php?error=preenchaoscampos&usuario=".$usuario);
    exit();
  }
}
 ?>
