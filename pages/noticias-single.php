<?php 
// Obtendo a categoria
$url = explode('/', $_GET['url']);

// Verifica se a categoria existe
$verificaCategoria = MySql::conectar()->prepare("SELECT * 
                                                FROM `tb_admin.categorias`
                                                WHERE slug = ?");
$verificaCategoria->execute(array($url[1]));

if ($verificaCategoria->rowCount() == 0) {
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

$categoriaInfo = $verificaCategoria->fetch();

// Verifica se a notícia existe
$post = MySql::conectar()->prepare("SELECT *        
                                   FROM `tb_admin.noticias`    
                                   WHERE slug = ?
                                   AND categoria_id = ?");
$post->execute(array($url[2], $categoriaInfo['id']));

if ($post->rowCount() == 0) {
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

// A notícia existe
$post = $post->fetch();
?>

<section class="noticia-single">
    <div class="center">
        <div class="text-center">
            <header>
                <h1><?php echo $post['titulo']; ?></h1>
            </header>
            <article>
                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $post['capa']; ?>">
                <?php echo $post['conteudo']; ?>
                <div class="box-single-conteudo btnVoltar">
                    <a href="<?php echo INCLUDE_PATH; ?>noticias">Voltar</a>
                </div>
                <div class="clear"></div><!--clear-->
            </article>
        </div>
    </div>
</section>