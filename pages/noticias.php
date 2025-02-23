<?php 
$url = explode('/', $_GET['url']);
//NÃO TEMOS NENHUMA NOTICIA CADASTRADA [0] ->NOTICIAS[1]-> CATEGORIA[2]NOME DA NOTICIA 
if (!isset($url[2])){

?>
    <section class="header-noticias">
        <div class="center">
            <h2><i class="fa-solid fa-bell"></i></h2>
            <h2>Acompanhe as últimas notícias da Radio Peão</h2>
        </div>
        <!--center-->
    </section>

    <section class="container-portal">
        <div class="center">
            <div class="sidebar">
                <div class="box-content-sidebar">
                    <h3><i class="fas fa-search"></i> Pesquisar: </h3>
                    <form method="post" action="">
                        <input type="text" name="busca" placeholder="Digite..." required>
                        <input type="submit" name="acao" value="Pesquisar">
                    </form>
                </div>
                <!--box-content-sidebar-->

                <div class="box-content-sidebar">
                    <h3><i class="fas fa-list"></i> Selecione a Categoria: </h3>
                    <form action="">
                        <select name="categoria" id="">
                            <option value="" selected="">Todas as categorias </option> 

                           <?php 
                           $categorias = MySql::conectar()->prepare("SELECT * 
                                                                    FROM 'tb_admin.categorias'
                                                                    ORDER BY order_id DESC");
                         $categoria->execute();
                         $categoria = $categoria->fetchAll();  
                           
                         foreach($categorias as $key => $value){
                        ?>
                            <option <?php if($value['slug'] == @$url[1])echo 'selected'; ?>
                                value="<?php echo $value ['slug'] ?>">
                                <?php echo $value['nome'];?></option>
                         <?php } ?>
                        </select>
                    </form>
                </div>
                <!--box-content-sidebar-->

                <div class="box-content-sidebar">
                    <h3><i class="fas fa-user"></i> Pesquisar: </h3>
                    <div class="text-center">
                        <div>
                            <img src="<?php echo INCLUDE_PATH; ?>assets/img/local-trabalho.png">
                        </div>
                        <?php echo $infoSite['nome_autor']; ?>
                        <?php echo $infoSite['descricao']; ?>
                    </div>
                    <!--text-center-->
                </div>
                <!--box-content-sidebar-->
            </div>
            <!--sidebar-->
        
            <div class="conteudo-portal">
                <div class="header-conteudo-portal">
                <?php 
               if(!isset($_POST['parametro'])) {
                if (@$categoria['nome']==''){
                    echo'<h2>Visualizando Todos os Post</h2>';
                }else{
                    echo '<h2> Visualizando Post em <span>'.$categoria['nome']. '</span></h2>';
                }
                }else{
                    echo '<h2><i class="fa fa-check"></i>'.$_POST['parametro'].'</h2>';

                }

                $query = "SELECT *FROM 'tb_admin.noticias' ";
                if($categoria['nome'] != ''){
                    $query.="WHERE categoria_id = $categoria[id]";
                }

                if(isset($_POST['parametro'])){
                    $parametro = $_POST['parametro'];
                    if(strstr($query, 'WHERE')!== false){
                        $query .=" AND $titulo LIKE '%$parametro%'";
                    }else{
                        $query .="WHERE titulo LIKE '%$parametro%'";
                    }

                }


                if(!isset($_POST['parametro'])){
                    if (isset($_GET['pagina'])){
                        $pagina = (int)$_GET['pagina'];
                        $queryPagina = ($pagina - 1)* $porPagina;
                        $query .="ORDER BY order_id DESC LIMIT $queryPagina,$porPagina";
                    }else{
                        $pagina = 1;
                        $query .= "ORDER BY order_id DESC LIMIT 0,$porPagina";
                    }
                }else{
                    $query .= "ORDER BY order_id DESC LIMIT 0, $porPagina";
                    }
                    
                $noticias = MySql::conectar()->prepare($query);
                $noticias->execute();
                $noticias = $noticias->fetchAll();
                 ?>    

                </div><!--header-conteudo-portal-->
                <?php foreach ($noticias as $key => $value) {
                    $sql = MySql::conectar()->prepare("SELECT 'slug'  FROM 'tb_admin.categorias' WHERE id=?");
                    $sql->execute(array($value['categoria_id']));
                    $categoriaNome = $sql ->fetch()['slug'];
                ?>
                <div class="box-single-conteudo">
                    <h2><?php echo $value['titulo'];?></h2>
                    <p><?php echo substr(strip_tags($value['conteudo']),0,0,400).'...';?></p>
                    <a href="<?php echo INCLUDE_PATH; ?>noticias/
                    <?php echo $categoriaNome;?>/
                    <?php echo $value['slug'];?>">Leia mais </a>
                </div> <!--box-single-conteudo-->
                <?php } ?>
            

            <?php
            $query = "SELECT * FROM 'tb_admin.moticias' ";
                    if(@$categoria['nome'] !=''){
                        $query.="WHERE categoria_id = $categoria[id]";
                    }
                    $totalPaginas = MySql::conectar()->prepare($query);
                    $totalPaginas->execute();
                    $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
            ?>
            </div>
            <!--conteudo-portal-->
            <div class="clear"></div>
            <div class="conteudo-portal">
                <div class="paginator">
                   <?php 
                   if(!isset($_POST['parametro'])){
                    for ($i = 1 ; $i <= $totalPaginas;$i++){
                        @$categoriaStr = ($categoria['nome'] !='')?'/' . $categoria['slug']:'';

                        if(@$pagina == $i){
                            echo'<a class="page-selected" href"' . INCLUDE_PATH_PAINEL . 'noticias'. $categoriaStr ;
                        }else{
                            echo'<a href="'. INCLUDE_PATH_PAINEL . 'noticias'.$categoriaStr .'?pagina=' . $i.'';
                        }
                    }
                }
                   ?>
                </div>
                <!--paginator-->
            </div>
            <!--conteudo-portal-->
            <div class="clear"></div>
        </div>
        <!--center-->
    
    </section>     
    <?php }else{
        include('noticias-single.php');
    } ?>
    
    
    <?php foreach($noticias as $key => $value ){
        $sql = MySql::conectar()->prepare("SELECT 'slug' FROM 'tb_admin.categorias' WHERE id=?");
        $sql ->execute(array($value['categoria_id']));
        $categoriaNome = $sql->fetch()['slug'];
    ?>
    <div class="box-single-conteudo">
    <h2><?php echo $value['titulo']; ?></h2>
    <p><?php echo substr(strip_tags($value['conteudo']),0,0,400).'...' ;?></p>
    </div><!---box-single-conteudo-->
    <?php } ?>

    