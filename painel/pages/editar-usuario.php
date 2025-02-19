<div class="box-content">
    <h2><i class="fas fa-edit"></i> Editar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $password = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new Usuario();

            if($imagem['name'] != ''){
                //O usuário selecionou a imagem
                if(Painel::validImage($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    if($usuario->updateUser($nome, $password, $imagem)){
                        $_SESSION['img'] = $imagem;
                        Painel::messageToUser('sucesso', 'Atualizado com sucesso com a imagem!');
                    }else{
                        Painel::messageToUser('erro', 'Não foi possível atualizar com a imagem');
                    }
                }else{
                    Painel::messageToUser('erro', 'Formatos de imagem permitidos (jpeg, jpg ou png');
                }
            }else{
                //O usuário não selecionou a imagem
                $imagem = $imagem_atual;
                if($usuario->updateUser($nome, $password, $imagem)){
                    Painel::messageToUser('sucesso', 'Atualizado com sucesso!');
                }else{
                    Painel::messageToUser('erro', 'Não foi possível atualizar');
                }
            }
        }
        ?>
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="imagem">Imagem: </label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
        </div>
        <!--form group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->