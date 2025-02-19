<?php include('config.php'); ?>
<?php Site::updateUserOnline(); ?>
<?php Site::countUser();?>

<?php
$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_admin.config`");
$infoSite->execute();
$infoSite = $infoSite->fetch();
?>

<!DOCTYPE html>
<html lang="en, pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--SFO = Search Engine Optimization-->
    <meta name="description" content="Descrição do site">
    <meta name="keywords" content="Palavra-chave 1, 2, 3, etc">

    <!--Google Fonts Open-Sans-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--CSS-->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>assets/css/style.css">

    <!--Título do site-->
    <title><?php echo $infoSite['titulo']; ?></title>

    <!--favicon-->
    <link rel="shortcut icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon">

    <title>IFPR</title>
</head>

<body>


    <?php
    //echo $_GET["url"]; printar na tela a url

    // Obtendo a url se exister ou home
    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    switch ($url) {
        case 'depoimentos':
            echo '<target target="depoimentos"/>';
            break;
        case 'servicos':
            echo '<target target="servicos"/>';
            break;
    }
    ?>

    <!--header-->
    <header>
        <div class="center">
            <div class="logo left">
                <a href="<?php echo INCLUDE_PATH;?>">
                    <img src="<?php echo INCLUDE_PATH;?>ifpr_logo.png" alt="IFPR">
                </a>
            </div>
            <nav class="desktop right">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>painel"><i class="fa-solid fa-user"></i></a></li>
                </ul>
            </nav>
            <nav class="mobile right">
                <div class="bars-mobile fa-solid fa-bars"></div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>painel"><i class="fa-solid fa-user"></i></a></li>
                </ul>
            </nav>
            <div class="clear"></div>
            <!--clear float-->
        </div>
        <!--center-->
    </header>
    <!--header-->

    <?php
    // Se $url existe
    if (file_exists('pages/' . $url . '.php')) {
        include('pages/' . $url . '.php');
    } else {
        if ($url != 'depoimentos' && $url != 'servicos') {
            $pagina404 = true;
            include('pages/404.php');
        } else {
            include('pages/home.php');
        }
    }
    ?>
    
    <!--footer-->
    <footer <?php if (isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
        <div class="center">
            <p>Todos os direitos reservados!</p>
        </div>
    </footer>
    <!--footer-->

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Jquery -->

    <!--JS-->
    <script src="<?php echo INCLUDE_PATH; ?>assets/js/scripts.js"></script>

    <?php if ($url == 'home' || $url == '' || $url == 'depoimentos' || $url == 'servicos') { ?>
    <script src="<?php echo INCLUDE_PATH; ?>assets/js/slider.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>assets/js/melhorEmail.js"></script>
    <!--WhatsApp Button-->
    <a href="https://wa.me/554221021443" class="btnWhatsApp" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <?php } ?>

    <?php if($url == 'home' || $url == ''){ ?>
    <script src="<?php echo INCLUDE_PATH; ?>assets/js/especialidades.js"></script>
    <?php }?>

</body>

</html>