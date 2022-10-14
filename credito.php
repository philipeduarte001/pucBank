<?php
session_start();
require_once "config.php";
require_once "recuperaCredito.php";
if(!isset($_SESSION['user_session']) && !isset($_SESSION['senha_session'])){ 
	echo "<meta http-equiv='refresh' content='0, ./login.php'>";
}elseif (isset($escrever['CPF']) == $_SESSION['user_session']) {
    echo "<meta http-equiv='refresh' content='0, ./creditoAp.php'>";
} else {    
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
                <br><br> Para solicitar o cartão de crédito favor preencher/confirmar os dados abaixo:
            </h5>
            <div class="div-cadastral-esq">
            <form method="POST" action="?go=solicitar">
                <div>
                    <h7>CEP: <br> </h7><input class="input-text-panel" type="text" id="cep" name="cep" value="<?php require_once "recuperaCliente.php"; echo $escrever['CEP']; ?>"/>
                </div>
                <div>
                    <h7>Endereço:<br> </h7><input class="input-text-panel" type="text" id="endereco" name="endereco"  value="<?php require_once "recuperaCliente.php"; echo $escrever['ENDERECO']; ?>"/>
                </div>
                <div>
                    <h7>E-mail:<br> </h7><input class="input-text-panel" type="text" id="email" name="email"  value="<?php require_once "recuperaCliente.php"; echo $escrever['EMAIL']; ?>"/>
                </div>
                <h6>Esses dados serão utilizados para o envio do cartão.
            </div>

            <div class="div-cadastral-dir">
                <br>
                <input type="submit" value="Solicitar" class="button-panel"><br><br>
            </form>
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

if(@$_GET['go'] == 'solicitar'){
	$cpf = $_SESSION['user_session'];

	$CEP = $_POST['cep'];
    $ENDERECO = $_POST['endereco'];
	$EMAIL = $_POST['email'];
    $VAL = "01/2050";
    $CODSEG = random_int(000, 999);
    $TIPO = 01;
    $LIMDISP = 2000;
    $LIMUTI = 0;
    $NUMBERCC2 = random_int(0000000000000000, 9999999999999999);
    $NUMBERCC = str_pad($NUMBERCC2 , 16 , '0' , STR_PAD_LEFT);

    mysqli_query($con, "insert into CARTAOCREDITO (CPF, NUMEROCARTAO, VALIDADE, CODIGOSEGURANCA, TIPOCARTAOCREDITO, LIMITEDISPONIVEL, LIMITEUTILIZADO) values ('$cpf','$NUMBERCC','$VAL','$CODSEG','$TIPO','$LIMDISP','$LIMUTI')");
    mysqli_query($con, "UPDATE CLIENTE SET CEP = '$CEP', ENDERECO = '$ENDERECO', EMAIL = '$EMAIL' WHERE CPF = '$cpf'");
    
    echo "<meta http-equiv='refresh' content='0, ./creditoAp.php'>";
}


?>