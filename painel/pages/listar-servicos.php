<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::delete('tb_admin.servicos', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_admin.servicos', $_GET['order'], $_GET['id']);
    }

$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 4;
$servicos = Painel::getAll('tb_admin.servicos', ($paginaAtual - 1) * $porPagina, $porPagina);
?>

<div class="box-content">
    <h2><i class="fas fa-database"></i> Serviços cadastrados</h2>

    <div class="wraper-table">
        <table>
            <tr>
                <td>Serviço</td>
                <td>Editar</td>
                <td>Excluir</td>
                <td>Descer</td>
                <td>Subir</td>
            </tr>
            <?php foreach (@$servicos as $key => $value) { ?>
            <tr>
                <td><?php echo $value['servico']; ?></td>
                <td><a class="edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="fas fa-edit"></i></a></td>
                <td><a actionBtn="delete" class="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id'];?>"><i class="fas fa-trash"></i></a></td>
                <td><a class="order-down" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
                <td><a class="order-up" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <!--wraper table-->

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::getAll('tb_admin.servicos')) / $porPagina);
            for ($i = 1; $i <= $totalPaginas ; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">'.$i.'</a';
                else
                    echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">'.$i.'</a>';
            }
        ?>
    </div>
    <!--paginacao-->
</div>
<!--box content-->