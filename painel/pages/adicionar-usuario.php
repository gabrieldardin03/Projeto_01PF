<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">
    <h2><i class="fas fa-edit"></i> Adicionar Usuário</h2>

    <form method="post">

        <?php
            if(isset($_POST['acao'])){
                $login = $_POST['login'];
                $nome = $_POST['nome'];
                $cargo = $_POST['cargo'];
                $password = $_POST['password'];

                if ($login == ''){
                    Painel::messageToUser('erro', 'Preencha o Login');
                } else if ($nome == '') {
                    Painel::messageToUser('erro', 'Preencha o Nome');
                } else if ($cargo == '') {
                    Painel::messageToUser('erro', 'Selecione o Cargo');
                } else if ($password == '') {
                    Painel::messageToUser('erro', 'Preencha o Senha');
                } else {

                    if ($cargo >= $_SESSION['cargo']) {
                        Painel::messageToUser('erro', 'Selecione um cargo menor do que o seu!');
                    } else if (Usuario::userExists($login)) {
                        Painel::messageToUser('erro', 'Login indisponível!');
                    } else {
                        // Podemos adicionar o usuário no BD
                        $usuario = new Usuario();
                        $usuario->registerUser($login, $password, $nome, $cargo);
                        Painel::messageToUser('sucesso', 'Usuário '.$login.' cadastrado com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label for="nome">Login: </label>
            <input type="text" name="login" required>
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required>
        </div>
        <!--form group-->

        <div class="form-group">
            <label for="cargos">Cargo: </label>
            <select name="cargo">
                <?php 
                    foreach (Painel::$cargos as $key => $value) {
                        if($key < $_SESSION['cargo'])
                        echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
        <!--form group-->

        <div class="form-group">
            <label for="password">Senha: </label>
            <input type="password" name="password" required>
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="imagem">Imagem: </label>
            <input type="file" name="imagem">
        </div>
        <!--form group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Adicionar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->