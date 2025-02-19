<?php
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $servico = Painel::get('tb_admin.servicos', 'id = ?', array($id));
    }else{
        Painel::messageToUser('erro', 'ID não existe');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fas fa-edit"></i> Editar Serviço</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            if(Painel::update($_POST)){
                Painel::messageToUser('sucesso', 'Serviço editado com sucesso!');
                $servico = Painel::get('tb_admin.servicos', 'id = ?', array($id));
            }else{
                Painel::messageToUser('erro', 'Campos vazios não são permitidos');
            }
        }
        ?>
        <div class="form-group">
            <label for="servico">Serviço: </label>
            <textarea name="servico"><?php echo $servico['servico']?></textarea>
        </div>
        <!--form group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nomeTabela" value="tb_admin.servicos">
            <input type="submit" name="acao" value="Atualizar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->