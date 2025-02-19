<div class="box-content">
    <h2><i class="fas fa-plus"></i> Adicionar Categoria</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];

            if ($nome == ''){
                    Painel::messageToUser('erro', 'Preencha o nome da categoria!');
            } else {
                $verificarCategoria = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE nome = ?");
                $verificarCategoria->execute(array($_POST['nome']));
                if($verificarCategoria->rowCount() == 0){
                    $slug = Painel::GenerateSlug($nome);
                    $arr = ['nome' => $nome, 'slug' => $slug, 'order_id' => '0', 'nomeTabela' => 'tb_admin.categorias'];
                    Painel::insert($arr); 
                    Painel::messageToUser('sucesso', 'O cadastro da categoria foi realizado com sucesso!');
                }else{
                    Painel::messageToUser('erro', 'Já existe uma categoria com este nome!');
                }
            }
        }  
        ?>

        <div class="form-group">
            <label for="nome">Nome da Categoria: </label>
            <input type="text" name="nome" required>
        </div>
        <!--form group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Adicionar">
        </div>
        <!--form group-->
    </form>
</div>
<!--box content-->