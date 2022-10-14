<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['user_session']) && !isset($_SESSION['senha_session'])){
	echo "<meta http-equiv='refresh' content='0, ./login.php'>";
}else{
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
             <input type="submit" value="Sair" class="btnSair" onclick="location.href = '?go=sair'">
        </div>
        <div class="div-ctd-painel">
            <button class="btn-menu"><a href="./painel.php"> Verificar Saldo </a></button>

            <button class="btn-menu"><a href="./cadastral.php"> Dados Cadastrais</a></button>

            <button class="btn-menu"><a href="./deposito.php"> Realizar Depósito</a></button>

            <button class="btn-menu"><a href="./transf.php"> Realizar Transferência</a></button>

            <button class="btn-menu"><a href="./emprestimo.php"> Ver Emprestimo</a></button>

            <button class="btn-menu"><a href="./credito.php"> Cartão de Crédito</a></button>

            <button class="btn-menu"><a href="./investimento.php"> Ver Investimentos</a></button>

            <button class="btn-menu"><a href="./cancelar.php"> Solicitar Cancelamento</a></button>

            <h5>
                Bem vindo,  
                <?php
                    require_once "recuperaCliente.php";
                    echo $escrever['NOME'] .'.';
                ?>
            </h5>
            <div class="div-cadastral-esq">
            <form method="POST" action="?go=att">
                <div>
                    <h7>Telefone:<br> </h7><input class="input-text-panel" type="text" id="telefone" name="telefone" value="<?php require_once "recuperaCliente.php"; echo $escrever['TELEFONE']; ?>" />
                </div>
                <div>
                    <h7>CEP: <br> </h7><input class="input-text-panel" type="text" id="cep" name="cep" value="<?php require_once "recuperaCliente.php"; echo $escrever['CEP']; ?>"/>
                </div>
                <div>
                    <h7>Endereço:<br> </h7><input class="input-text-panel" type="text" id="endereco" name="endereco"  value="<?php require_once "recuperaCliente.php"; echo $escrever['ENDERECO']; ?>"/>
                </div>
                <div>
                    <h7>E-mail:<br> </h7><input class="input-text-panel" type="text" id="email" name="email"  value="<?php require_once "recuperaCliente.php"; echo $escrever['EMAIL']; ?>"/>
                </div>
                <div>
                    <h7>Identidade:<br> </h7><input class="input-text-panel" type="text" id="identidade" name="identidade"  value="<?php require_once "recuperaCliente.php"; echo $escrever['IDENTIDADE']; ?>"/>
                </div>
                <div>
                    <h7>Profissão:<br> </h7><input class="input-text-panel" type="text" id="profissao" name="profissao"  value="<?php require_once "recuperaCliente.php"; echo $escrever['PROFISSAO']; ?>"/>
                </div>
            </div>

            <div class="div-cadastral-dir">
                <br>
                <input type="submit" value="Atualizar" class="button-panel"><br><br>
            </form>
                <input type="submit" value="Excluir" class="button-panel" onclick="location.href = '?go=excluir'">
            </div>

        </div>
    </div>
</body>
</html>

<?php
}

if(@$_GET['go'] == 'sair'){
	unset($_SESSION['user_session']);
	unset($_SESSION['senha_session']);
	echo "<meta http-equiv='refresh' content='0, ./login.php'>";
}

if(@$_GET['go'] == 'att'){
	$cpf = $_SESSION['user_session'];

    $TELEFONE = $_POST['telefone'];
	$CEP = $_POST['cep'];
    $ENDERECO = $_POST['endereco'];
	$EMAIL = $_POST['email'];
    $IDENTIDADE = $_POST['identidade'];
	$PROFISSAO = $_POST['profissao'];

    mysqli_query($con, "UPDATE CLIENTE SET TELEFONE = '$TELEFONE', CEP = '$CEP', ENDERECO = '$ENDERECO', EMAIL = '$EMAIL', IDENTIDADE = '$IDENTIDADE', PROFISSAO = '$PROFISSAO' WHERE CPF = '$cpf'");
    echo "<script>alert('Cadastro atualizado com sucesso.');</script>";
	echo "<meta http-equiv='refresh' content='0, ./cadastral.php'>";
}

if(@$_GET['go'] == 'excluir'){
	$cpf = $_SESSION['user_session'];
    mysqli_query($con, "UPDATE CLIENTE SET TELEFONE = '', CEP = '', ENDERECO = '', EMAIL = '', IDENTIDADE = '', PROFISSAO = '' WHERE CPF = '$cpf'");
    echo "<script>alert('Cadastro excluido com sucesso.');</script>";
    echo "<meta http-equiv='refresh' content='0, ./cadastral.php'>";

}



?>