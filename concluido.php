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
            <img class= "img-sus" src="img/icone.png" width="100px" weigth="100px">
            <h3>Tudo certo, cadastro realizado com sucesso!</h3><br>
            <form action="./login.php">
              <button class="btn-entrar">Entrar no sistema</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
}else{
	echo "<meta http-equiv='refresh' content='0, ./painel.php'>";
}
?>