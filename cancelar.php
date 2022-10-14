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
                <h4>Deseja realmente excluir a conta? <b> <br></h4>
                <h7>  
                    CPF: 
                    <?php
                        require_once "recuperaCliente.php";
                        echo $escrever['CPF'];
                    ?>
                    <br>
                   Agencia: 
                    <?php
                        require_once "recuperaConta.php";
                        echo $escrever['AGENCIA'];
                    ?>
                     <br>
                   Conta: 
                    <?php
                        require_once "recuperaConta.php";
                        echo $escrever['ID'];
                    ?>
                </h5> <br> <br>
                </b>
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


if(@$_GET['go'] == 'excluir'){
	$cpf = $_SESSION['user_session'];
    mysqli_query($con, "DELETE FROM CLIENTE WHERE CPF = '$cpf'");
    mysqli_query($con, "DELETE FROM CONTA WHERE CPF = '$cpf'");
    mysqli_query($con, "DELETE FROM CARTAOCREDITO WHERE CPF = '$cpf'");
    unset($_SESSION['user_session']);
	unset($_SESSION['senha_session']);
    echo "<script>alert('Conta excluida com sucesso.');</script>";
    echo "<meta http-equiv='refresh' content='0, ./index.php'>";

}



?>