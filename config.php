<?php
    session_start(); // Cria uma sessão ou retorna a atual com base em um identificador passado por meio de uma solicitação GET ou POST ou passado por meio de um cookie
    
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de São Paulo

    define('NOME_EMPRESA', 'Radio Peão'); // Nome da Empresa

    define('INCLUDE_PATH', 'http://localhost/Projeto_01PF/'); // Definir o domínio do site
    
    define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/'); // Definir a URL do painel

    define('BASE_DIR_PAINEL', __DIR__.'/painel/'); // Diretório base as imagens

    //Banco de dados
    define('HOST', 'localhost'); //Hospedagem
    define('DATABASE', 'projeto_01'); //Banco
    define('USER', 'root'); //Usuario
    define('PASSWORD', ''); //Senha
    
    $autoload = function($class){
        include('assets/classes/'.$class.'.php'); // Carregando a classe: 'Email'
    };

    spl_autoload_register($autoload);

    // Função para os cargos dentro do painel
    function pegaCargo($indice){
        return Painel::$cargos[$indice];
    }

    // Função para o menu selecionado
    function selecionaMenu($menuItem){
        $url = explode('/',@$_GET['url'])[0];
        if($url == $menuItem){
            echo 'class="menu-active"';
        }
    }

    // Função para verificar a permissão do usuário
    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return true;
        }else{
            echo 'style="display:none"';
        }
    }

    // Função para verificar a permissão para exibir a página na url
    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return true;
        }else{
            include('painel/pages/permissao_negada.php');
            die();
        }
    }

    // Função para recuperar os campos
    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }
?>