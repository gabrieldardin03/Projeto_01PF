<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT slide
                                                    FROM `tb_admin.slides`
                                                    WHERE id = ?");
        $selectImagem->execute(array($idExcluir));
        $imagem = $selectImagem->fetch()['slide'];
        Painel::deleteFile($imagem);
        Painel::delete('tb_admin.slides', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_admin.slides', $_GET['order'], $_GET['id']);
    }

$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 4;
$slides = Painel::getAll('tb_admin.slides', ($paginaAtual - 1) * $porPagina, $porPagina);
?>

<div class="box-content">
    <h2><i class="fas fa-database"></i> Slides cadastrados</h2>

    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>Imagem</td>
                <td>Editar</td>
                <td>Excluir</td>
                <td>Descer</td>
                <td>Subir</td>
            </tr>
            <?php foreach ($slides as $key => $value) { ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><img style="width:60px; height=60px;" ;
                        src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $value['slide'];?>"></td>
                <td><a class="edit"
                        href="<?php echo INCLUDE_PATH_PAINEL ?>editar-slide?id=<?php echo $value['id']; ?>"><i
                            class="fas fa-edit"></i></a></td>
                <td><a actionBtn="delete" class="delete"
                        href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?excluir=<?php echo $value['id'];?>"><i
                            class="fas fa-trash"></i></a></td>
                <td><a class="order-down"
                        href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=up&id=<?php echo $value['id']; ?>"><i
                            class="fa-solid fa-angle-down"></i></a></td>
                <td><a class="order-up"
                        href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=down&id=<?php echo $value['id']; ?>"><i
                            class="fa-solid fa-angle-up"></i></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <!--wraper table-->

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::getAll('tb_admin.slides')) / $porPagina);
            for ($i = 1; $i <= $totalPaginas ; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a';
                else
                    echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a>';
            }
        ?>
    </div>
    <!--paginacao-->
</div>
<!--box content-->