<?php
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $servico = Painel::get('tb_admin.slides', 'id = ?', array($id));
    }else{
        Painel::messageToUser('erro', 'ID não existe');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fas fa-edit"></i> Editar Slide</h2>
    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];

            if($imagem['name'] != ''){
                //O usuário selecionou a imagem
                if(Painel::validImage($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nomeTabela'=>'tb_admin.slides'];
                    Painel::update($arr);
                    $slide = Painel::get('tb_admin.slides', 'id = ?', array($id));
                    Painel::messageToUser('sucesso', 'Slide atualizado com a imagem!');
                }else{
                    Painel::messageToUser('erro', 'Formatos de imagem permitidos (jpeg, jpg ou png');
                }
            }else{
                //O usuário não selecionou a imagem
                $imagem = $imagem_atual;
                $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nomeTabela'=>'tb_admin.slides'];
                Painel::update($arr);
                $slide = Painel::get('tb_admin.slides', 'id = ?', array($id));
                Painel::messageToUser('sucesso', 'Slide atualizado!');
            }
        }
        ?>
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="imagem">Imagem: </label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
        </div>
        <!--form group-->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->