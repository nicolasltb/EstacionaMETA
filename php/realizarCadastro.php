<?php
include_once 'conexao.php';
if(isset($_POST['cadastrar'])){
  $usuario = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  //checa se todos campos foram preenchidos
  if(!empty($usuario)&&!empty($email)&&!empty($senha)){
    //checa se email é válido
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
      //checa se usuário é válido
      if(preg_match("/^[a-zA-Z0-9]*$/",$username)){
        //checa se conexão foi feita com sucesso
        if($conexao){
          $sql = "SELECT nome FROM usuarios WHERE nome=?";
          $stmt = mysqli_stmt_init($conexao);
          //checa se é possivel executar declaracao
          if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$usuario);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            //checa se usuário ja havia sido cadastrado
            if(mysqli_stmt_num_rows($stmt) == 0){
              $sql = "INSERT INTO usuarios(nome,email,senha) values(?,?,?)";
              $stmt = mysqli_stmt_init($conexao);
              //checa se é possivel executar declaracao
              if(mysqli_stmt_prepare($stmt,$sql)){
                mysqli_stmt_bind_param($stmt,"sss",$usuario,$email,password_hash($senha, PASSWORD_DEFAULT));
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                header("Location: ../login.php");
                exit();
              } else {
                header("Location: ../cadastro.php?error=errosql&nome=".$usuario."&email=".$email);
                exit();
              }
            } else {
              header("Location: ../cadastro.php?error=usuariojacadastrado&email=".$email);
              exit();
            }
          } else {
            header("Location: ../cadastro.php?error=errosql&nome=".$usuario."&email=".$email);
            exit();
          }
        } else {
          header("Location: ../cadastro.php?error=erronaconexao&nome=".$usuario."&email=".$email);
          exit();
        }
      } else {
        header("Location: ../cadastro.php?error=usuarioinvalido&email=".$email);
        exit();
      }
    } else {
      header("Location: ../cadastro.php?error=emailinvalido&nome=".$usuario);
      exit();
    }
  } else {
    header("Location: ../cadastro.php?error=preenchaoscampos");
    exit();
  }
}
 ?>
