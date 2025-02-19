<?php 
    include('../config.php');
    if(Painel::logado() == true){
        include('main.php');
    }else{
        include('login.php');
    }
?>