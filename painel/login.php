<?php 
    if(isset($_COOKIE['lembrar'])) {
        @$user = $_COOKIE['user'];
        @$password = $_COOKIE['password'];
        $sql = MySql::conectar->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql = execute(array($user, $password));
        if ($sql->rowCount() == 1) {
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['img'] = $info['img'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];
            header('Location: ' . INCLUDE_PATH_PAINEL);
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en, pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <title>Painel de controle</title>
</head>

<body>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
        <title>Painel de Controle</title>
    </head>

    <body>
        <div class="box-login">
            <?php
                if (isset($_POST['acao'])) {
                    $user = $_POST['user'];
                    $password = $_POST['password'];
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
                    $sql->execute(array($user, $password));
                    if ($sql->rowCount() == 1) {
                        $info = $sql->fetch();
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $password;
                        $_SESSION['img'] = $info['img'];
                        $_SESSION['nome'] = $info['nome'];
                        $_SESSION['cargo'] = $info['cargo'];
                        if(isset($_POST['lembrar'])){
                            setcookie('lembrar', true, time() + (60*60*24*30*12), '/');
                            setcookie('user', $user, time() + (60*60*24*30*12), '/');
                            setcookie('password', $password, time() + (60*60*24*30*12), '/');
                        }
                        
                        header('Location: ' . INCLUDE_PATH_PAINEL);
                        die();
                    } else {
                        echo '<div class="erro-box"><i class="fa-solid fa-times"></i>Usuário ou senha incorretos!</div>';
                    }
                }
            ?>

            <img src="ifpr-login.png">

            <form action="" method="post">
                <input type="text" name="user" placeholder="Login" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="acao" value="Logar">
                <label for="lembrar">Lembrar-me</label>
                <input type="checkbox" name="lembrar" id="">
            </form>
            <br>
            <a class="voltar" href="<?php echo INCLUDE_PATH; ?>">Página inicial?</a>
        </div>
    </body>

</html>