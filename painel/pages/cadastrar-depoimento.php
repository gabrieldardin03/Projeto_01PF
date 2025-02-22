
<div class="box-content">
    <h2><i class="fas fa-plus"></i> Adicionar Depoimento</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            if(Painel::insert($_POST)){
            Painel::messageToUser('sucesso', 'Depoimento cadastrado com sucesso!');
            }else{
                Painel::messageToUser('erro', 'Não foi possível cadastrar o depoimento');
            }
        }
        ?>
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="<?php recoverPost('nome');?>" required>
        </div>
        <!--form group-->
        <div class="form-group">
            <label for="depoimento">Depoimento: </label>
            <textarea class="tinymce" name="depoimento" id=""><?php recoverPost('depoimento');?></textarea>
        </div>
        <!--form group-->
        <!--form group-->
        <div class="form-group">
            <label for="nome">Data: </label>
            <input formato="data" type="text" name="data" required>
        </div>
        <!--form group-->
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nomeTabela" value="tb_admin.depoimentos">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->