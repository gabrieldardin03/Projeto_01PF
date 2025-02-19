<section class="header-noticias">
    <div class="center">
        <h2><i class="fa-solid fa-bell"></i></h2>
        <h2>Acompanhe as últimas notícias do portal</h2>
    </div>
    <!--center-->
</section>

<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3><i class="fas fa-search"></i> Pesquisar: </h3>
                <form action="">
                    <input type="text" name="busca" placeholder="Digite..." required>
                    <input type="submit" name="acao" value="Pesquisar">
                </form>
            </div>
            <!--box-content-sidebar-->

            <div class="box-content-sidebar">
                <h3><i class="fas fa-list"></i> Selecione a Categoria: </h3>
                <form action="">
                    <select name="categoria" id="">
                        <option value="esportes">Esportes</option>
                        <option value="geral">Geral</option>
                    </select>
                </form>
            </div>
            <!--box-content-sidebar-->

            <div class="box-content-sidebar">
                <h3><i class="fas fa-user"></i> Sobre o autor: </h3>
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
                <h2>Visualizando Post em <span>Esportes</span></h2>
            </div>
            <!--header-conteudo-portal-->
            <?php for ($i = 0; $i < 21; $i++) {

            ?>
            <div class="box-single-conteudo">
                <h2>Conheça as novidades do Esp...</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur, dolores eligendi totam amet harum
                    reiciendis voluptas reprehenderit cupiditate, aperiam nemo porro suscipit omnis dolore? Harum dolor
                    eveniet repellendus et vero?</p>
                <a href="<?php echo INCLUDE_PATH; ?>noticias/esportes/nome-do-post">Leia mais</a>
            </div>
            <!--box-single-conteudo-->
            <?php } ?>
        </div>
        <!--conteudo-portal-->
        <div class="clear"></div>
        <div class="conteudo-portal">
            <div class="paginator">
                <a href="" class="active-page">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
            </div>
            <!--paginator-->
        </div>
        <!--conteudo-portal-->
        <div class="clear"></div>
    </div>
    <!--center-->
</section>