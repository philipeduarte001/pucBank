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

            <font color="black" size="4px">
            <?php
            $nome = $_SESSION['nome'];       
            echo $nome. ',<br>informe os dados abaixo';
            ?> 
            </font><br><br>
            <form method="POST" action="?go=cadastrar">
                <div>
                    <input class="input-text" type="text" id="cpf" name="cpf" placeholder="CPF xxx.xxx.xxx-xx"  />
                </div>
                <div>
                    <input class="input-text" type="text" id="tel" name="tel" placeholder="Telefone (xx) xxxxx-xxxx" />
                </div>
                <div>
                    <input class="input-text" type="password" id="password" name="senha" placeholder="Confirme sua senha" />
                </div>
                <div>
                    <input type="radio" id="aceito" name="aceito"/> <label for="aceito" class="input-radio">Eu aceito os termos do contrato.</label> 
                </div>
                    <button class="button-cnt"  type="submit">Finalizar</button>
            </form>
            <h4>Já possui uma conta? <font color="#07B464"> Entrar agora</font></h4>
        </div>
        <div class="div-ctd-dir">

            <h3>Termos do contrato</h3>
            <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.      
            </h6>
            
        </div>
    </div>
</body>
</html>

<?php
}else{
	echo "<meta http-equiv='refresh' content='0, ./painel.php'>";
}

if(@$_GET['go'] == 'cadastrar'){
    $email = $_SESSION['email'];  
    $senha = $_SESSION['senha'];  

	$cpf = $_POST['cpf'];
	$tel = $_POST['tel'];
	$senha2 = $_POST['senha'];
    $aceito = $_POST['aceito'];

	if($senha != $senha2){
		echo "<script>alert('As senhas não conferem.'); history.back();</script>";
	}elseif(empty($cpf)){
		echo "<script>alert('Favor informar seu CPF.'); history.back();</script>";
	}elseif(empty($tel)){
		echo "<script>alert('Favor informar seu telefone.'); history.back();</script>";
    }elseif($aceito <> 'on'){
		echo "<script>alert('Você deve aceitar os termos para prosseguir.'); history.back();</script>";
	}else{
		$query1 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM CLIENTE WHERE CPF = '$cpf'"));
		if ($query1 ==1){
			echo "<script>alert('CPF já existe em nossa base de dados.'); history.back();</script>";
		}else{
			mysqli_query($con, "insert into CLIENTE (NOME, CPF, TELEFONE, EMAIL, SENHA) values ('$nome','$cpf','$tel','$email','$senha')");
            mysqli_query($con, "insert into CONTA (CPF, AGENCIA, SALDO, DATA_CRIACAO, POSSUI_CREDITO_EMPRESTIMO, POSSUI_CARTAO_CREDITO, ATIVO, POSSUI_INVESTIMENTO) values ('$cpf','0001','0',Now(), '1', '1', '1', '1')");
			echo "<script>alert('Usuário cadastrado com sucesso.');</script>";
			echo "<meta http-equiv='refresh' content='0, ./concluido.php'>";
		}
	}
}
?>