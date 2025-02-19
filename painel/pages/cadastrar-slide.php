<div class="box-content">
    <h2><i class="fas fa-plus"></i> Adicionar Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];

                if ($nome == ''){
                    Painel::messageToUser('erro', 'Preencha o nome do slide!');
                } else {
                    if (Painel::validImage($imagem) == false) {
                        Painel::messageToUser('erro', 'Formatos de imagem permitidos (jpeg, jpg ou png)');
                    } else {
                        $imagem = Painel::uploadFile($imagem);
                        $arr = ['nome'=>$nome, 'slide'=>$imagem, 'order_id'=>'0', 'nomeTabela'=>'tb_admin.slides'];
                        Painel::insert($arr);
                        Painel::messageToUser('sucesso', 'O cadastro do slide foi realizado com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label for="nome">Nome do Slide: </label>
            <input type="text" name="nome" required>
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