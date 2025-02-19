<?php
    class Site{
        public static function updateUserOnline(){
            if(isset($_SESSION['online'])){ // Se Existe a sessão online
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $check = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
                $check->execute(array($token));
                if($check->rowCount() == 1){
                    $sql = MySql::conectar()->prepare("UPDATE `tb_admin.online` SET ultima_acao = ? WHERE token = ?");
                    $sql->execute(array($horarioAtual, $token));
                }
            }else{
                // Acessando o site pela primeira vez
                $_SESSION['online'] = uniqid();
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?);");
                $sql->execute(array($ip, $horarioAtual, $token));
            }
        }

        public static function countUser(){
            if(!isset($_COOKIE['visita'])){
                $ip = $_SERVER['REMOTE_ADDR'];
                setcookie('visita', true, time()+(60*60*24*30));
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null,?,?)");
                $sql->execute(array($ip, date('Y-m-d')));
            }
        }
    }
?>