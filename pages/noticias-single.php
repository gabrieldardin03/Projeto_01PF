<?php 
//obtendo a categoria

$url = explode('/',$_GET['url']);
$verificaCategoria = MySql::conectar()->prepare("SELECT * 
                                                FROM 'tb_admin.categorias'
                                                  WHERE slug = ?");

$verificaCategoria->execute(array($url[1]));
if($verificaCategoria->rowCount() == 0){
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

$categoriaInfo = $verificaCategoria->fetch();
$post = MySql::conectar()->prepare("SELECT *        
                                   FROM 'tb_admin.noticias'       
                                   WHERE slug = ?
                                   AND categoria_id =?");
$post->execute(array($url[2], $categoriaInfo['id']));
if($post->rowCount() == 0){
    Painel::redirect(INCLUDE_PATH .'noticias');
}
                                        
//a minha noticia existe

$post = $post->fetch();
?>