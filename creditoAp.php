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
                <br><br> Você possui um cartão de crédito ativo!
            </h5>
            <div class="div-cartao-esq">
                <div>
                    Número do Cartão:  
                        <?php require_once "recuperaCredito.php"; echo $escrever['NUMEROCARTAO']; ?>
                </div>
                <div>
                    Validade: 
                        <?php require_once "recuperaCredito.php"; echo $escrever['VALIDADE']; ?>
                </div>
                <div>
                    Cod. Segurança: 
                        <?php require_once "recuperaCredito.php"; echo $escrever['CODIGOSEGURANCA']; ?>
                </div>
                <div>
                    Limite Utilizado 
                        <?php require_once "recuperaCredito.php"; echo 'R$' .$escrever['LIMITEUTILIZADO']. ',00'; ?>
                </div>
            <form method="POST" action="?go=attcar">
                <div>
                    Limite Disponível: <input class="input-text-panel-car" type="text" id="limite" name="limite"  value="<?php require_once "recuperaCliente.php"; echo $escrever['LIMITEDISPONIVEL']; ?>"/>
                    <h6>Altere seu limite no campo acima.
                </div>
                
            </div>

            <div class="div-cartao-dir">
                
                <input type="submit" value="Alterar Limite" class="button-panel-car"><br><br>
            </form>
                <input type="submit" value="Cancelar Cartão" class="button-panel-car" onclick="location.href = '?go=excluir'">
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

if(@$_GET['go'] == 'attcar'){
	$cpf = $_SESSION['user_session'];

    $LIMITE = $_POST['limite'];

    mysqli_query($con, "UPDATE CARTAOCREDITO SET LIMITEDISPONIVEL = '$LIMITE' WHERE CPF = '$cpf'");
    echo "<script>alert('Limite atualizado com sucesso.');</script>";
    echo "<meta http-equiv='refresh' content='0, ./creditoAp.php'>";
}

if(@$_GET['go'] == 'excluir'){
	$cpf = $_SESSION['user_session'];
    mysqli_query($con, "DELETE FROM CARTAOCREDITO WHERE CPF = '$cpf'");
    echo "<script>alert('Cartão cancelado com sucesso.');</script>";
    echo "<meta http-equiv='refresh' content='0, ./credito.php'>";

}



?>