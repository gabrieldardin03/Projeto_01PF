<?php
    class Usuario{
        public function updateUser($nome, $password, $imagem){
            $sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, password = ?, img = ? WHERE user = ?");
            if($sql->execute(array($nome, $password, $imagem, $_SESSION['user']))){
                return true;
            }
            return false;
        }

        public static function userExists($login){
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user = ?");
            $sql->execute(array($login));
            if($sql->rowCount() == 1)
                return true;
            return false;
        }

        public function registerUser($login, $password, $nome, $cargo){
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($login, $password, '', $nome, $cargo));
        }
    }
?>