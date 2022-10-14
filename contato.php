<?php
    session_start();
    require_once "config.php";
    if(!isset($_SESSION['user_session']) && !isset($_SESSION['senha_session'])){
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>PUC BANK</title>
</head>
<body>
    <div class="div-bloco">
        <div class="div-men-esq">
            <h2><font color="black">PUC</font>BANK </h2>
        </div>
        <div class="div-men-dir">
            <font color="#FD6F00" size="4px"><b>•</b></font><a href="./index.php"> HOME  </a>
            <font color="#FD6F00" size="4px"><b>•</b></font><a href="./quemsomos.php"> QUEM SOMOS  </a>
            <font color="#FD6F00" size="4px"><b>•</b></font><a href="./login.php"> LOGIN  </a>
            <font color="#FD6F00" size="4px"><b>•</b></font><a href="./contato.php"> CONTATO  </a>
        </div>
        <div class="div-ctd-cen">
        <h2>Não conseguimos processar a página no momento,<br>favor retornar mais tarde! :( <b>
                </b></h2>
        </div>
    </div>
</body>
</html>


<?php
}else{
	echo "<meta http-equiv='refresh' content='0, ./painel.php'>";
}
?>

<?php
if(@$_GET['go'] == 'login'){
	$cpf = $_POST['cpf'];
	$password = $_POST['password'];

	if(empty($cpf)){
		echo "<script>alert('Preencha o seu CPF.'); history.back();</script>";
	}elseif(empty($password)){
		echo "<script>alert('Preencha sua senha.'); history.back();</script>";
	}else{
		$query1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM CLIENTE WHERE CPF = '$cpf' AND SENHA = '$password'"));
		if ($query1 ==1){
			$_SESSION['user_session'] = $cpf;
			$_SESSION['senha_session'] = $password;
			echo "<meta http-equiv='refresh' content='0, ./painel.php'>";
		}else{
			echo "<script>alert('Usuário e senha não conferem.'); history.back();</script>";
		}
	}
}
?>