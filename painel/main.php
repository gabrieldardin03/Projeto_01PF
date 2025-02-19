<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}
?>

<!DOCTYPE html>
<html lang="en, pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <title>Painel de controle</title>
</head>

<body>

    <!--Barra Lateral Esquerda-->
    <aside>
        <div class="box-usuario">
            <?php if ($_SESSION['img'] == '') { ?>
            <div class="avatar-usuario">
                <i class="fa-solid fa-user"></i>
            </div>
            <?php } else { ?>

            <div class="imagem-usuario">
                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
            </div>
            <?php } ?>

            <div class="nome-usuario">
                <h2><?php echo $_SESSION['nome']; ?></h2>
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
            </div>
        </div>

        <div class="items-menu">
            <h2>Cadastro</h2>
            <a <?php selecionaMenu('cadastrar-slide');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-slide">Slide</a>
            <a <?php selecionaMenu('cadastrar-depoimento');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-depoimento">Depoimentos</a>
            <a <?php selecionaMenu('cadastrar-servico');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-servico">Serviço</a>
            <a <?php selecionaMenu('cadastrar-categoria');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-categoria">Categoria</a>
            <a <?php selecionaMenu('cadastrar-noticia');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-noticia">Notícia</a>

            <h2>Gestão</h2>
            <a <?php selecionaMenu('listar-slides');?> href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides">Slide</a>
            <a <?php selecionaMenu('listar-depoimentos');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos">Depoimentos</a>
            <a <?php selecionaMenu('listar-servicos');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>listar-servicos">Serviço</a>
            <a <?php selecionaMenu('listar-categorias');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>listar-categorias">Categorias</a>
            <a <?php selecionaMenu('listar-noticias');?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>listar-noticias">Notícias</a>

            <h2>Usuário</h2>
            <a <?php selecionaMenu('editar-usuario')?>
                href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario">Editar</a>
            <a <?php selecionaMenu('adicionar-usuario')?> <?php verificaPermissaoMenu(2) ?>
                href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-usuario">Adicionar</a>
            <h2>Configuração</h2>
            <a <?php selecionaMenu('editar');?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-site">Editar</a>
        </div>
    </aside>

    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="logout">
                <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </div>
            <!--logout-->

            <div class="home-btn">
                <a <?php if (@$_GET['url'] == '') { ?> style="color:black;" <?php } ?>
                    href="<?php echo INCLUDE_PATH_PAINEL; ?>">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                </a>
            </div>
            <!--home-btn-->

            <div class="clear"></div>
        </div>
        <!--center-->
    </header>

    <div class="content">
        <?php
            Painel::loadPage();
        ?>
    </div>
    <!--content-->

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Jquery -->

    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery_mask.js"></script>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/e44omhvwjani1pnvgoylkv16y53m38s2de33b6471bltkzhi/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: '.tinymce',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
            'searchreplace', 'table', 'visualblocks', 'wordcount',
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
            'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
            'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
            'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500
    });
    </script>

</body>

</html>