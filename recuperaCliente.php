<?php
    $cpf = $_SESSION['user_session'];
    $res = mysqli_query($con, "SELECT * FROM CLIENTE WHERE CPF = '$cpf'");
    $escrever=mysqli_fetch_array($res);
?> 