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
        <div class="div-ctd-esq">
            <h1>PUC<font color="#FD6F00">BANK</font></h1>
            <h3>O Banco Digital que facilita a vida do universitário</h3>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.       
            </h4>
            <button class="btn-saiba">Saiba mais</button>
        </div>
        <div class="div-ctd-dir">

            <font color="black" size="5px">Crie sua conta</font><br><br>
            <form method="POST" action="?go=cadastrar">
                <div>
                    <input class="input-text" type="text" id="name" name="nome" placeholder="Nome completo"  />
                </div>
                <div>
                    <input class="input-text" type="text" id="mail" name="email" placeholder="E-mail" />
                </div>
                <div>
                    <input class="input-text" type="password" id="password" name="senha" placeholder="Senha" />
                </div>
                    <input type="submit" value="Continuar" class="button-cnt" id="btnEntrar">
            </form>
            <h4>Já possui uma conta? <font color="#07B464"> <a href="./login.php"> Entrar agora</font></h4>
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
if(@$_GET['go'] == 'cadastrar'){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	if(empty($nome)){
		echo "<script>alert('Favor informar seu nome.'); history.back();</script>";
	}elseif(empty($email)){
		echo "<script>alert('Favor informar seu e-mail.'); history.back();</script>";
	}elseif(empty($senha)){
		echo "<script>alert('Favor informar sua senha'); history.back();</script>";
	}else{
        $_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        echo "<meta http-equiv='refresh' content='0, ./cadastro.php'>";
		}
}
?>