<?php
class Painel {
    public static $cargos = [
        '0' => 'Normal',
        '1' => 'Sub-administrador',
        '2' => 'Administrador'
    ];

    // Método para gerar um slug a partir de uma string
    public static function generateSlug($str) {
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(ó|ô|õ|Ô|º)/', 'o', $str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '', $str);
        $str = preg_replace('/( )/', '-', $str);
        $str = preg_replace('/ç/', 'c', $str);
        $str = preg_replace('/(-[-]{1,})/', '-', $str);
        $str = preg_replace('/(,)/', '-', $str);
        return $str;
    }

    // Verifica se o usuário está logado
    public static function logado() {
        return isset($_SESSION['login']) ? true : false;
    }

    // Realiza o logout do usuário
    public static function logout() {
        setcookie('lembrar', true, time() - 3600, '/');
        session_destroy();
        header('Location: ' . INCLUDE_PATH_PAINEL);
    }

    // Carrega uma página com base na URL
    public static function loadPage() {
        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
            if (file_exists('pages/' . $url[0] . '.php')) {
                include('pages/' . $url[0] . '.php');
            } else {
                header('Location: ' . INCLUDE_PATH_PAINEL);
            }
        } else {
            include('pages/home.php');
        }
    }

    // Deleta usuários online inativos
    public static function deleteUserOnline() {
        $date = date('Y-m-d H:i:s');
        MySql::conectar()->exec("DELETE FROM `tb_admin.online` WHERE `ultima_acao` < '$date' - INTERVAL 30 MINUTE");
    }

    // Lista usuários online
    public static function listUserOnline() {
        self::deleteUserOnline();
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");
        $sql->execute();
        return $sql->fetchAll();
    }

    // Obtém o total de usuários
    public static function getUserTotal() {
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
        $sql->execute();
        return $sql->rowCount();
    }

    // Obtém o total de usuários hoje
    public static function getUserTotalToday() {
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
        $sql->execute(array(date('Y-m-d')));
        return $sql->rowCount();
    }

    // Exibe mensagens para o usuário
    public static function messageToUser($type, $message) {
        if ($type == 'sucesso') {
            echo '<div class="box-alert sucesso"><i class="fa-solid fa-check"></i> ' . $message . '</div>';
        } else {
            echo '<div class="box-alert erro"><i class="fa-solid fa-times"></i> ' . $message . '</div>';
        }
    }

    // Valida uma imagem
    public static function validImage($image) {
        if ($image['type'] == 'image/jpeg' ||
            $image['type'] == 'image/jpg' ||
            $image['type'] == 'image/png') {

            $size = intval($image['size'] / 1024);
            if ($size < 500) {
                return true;
            } else {
                Painel::messageToUser('erro', 'O tamanho do arquivo precisa ser menor do que 500 kb');
            }
        }
        return false;
    }

    // Faz upload de um arquivo
    public static function uploadFile($file) 
    {
        $formatoArquivo = explode('.', $file['name']);
        $nomeImagem = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if (move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL . 'uploads/' . $nomeImagem))
            return $nomeImagem;
        return false;
    }

    // Deleta um arquivo
    public static function deleteFile($file) {
        @unlink('uploads/' . $file);
    }

    // Lista usuários do painel
    public static function painelUsers() {
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
        $sql->execute();
        return $sql->fetchAll();
    }

    // Insere dados em uma tabela
    public static function insert($arr) {
        $certo = true;
        $nomeTabela = $arr['nomeTabela'];
        $query = "INSERT INTO `$nomeTabela` VALUES (null";
        $parametros = []; // Inicializa o array de parâmetros
        foreach ($arr as $key => $value) {
            $nome = $key;
            if ($nome == 'acao' || $nome == 'nomeTabela')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }
            $query .= ",?";
            $parametros[] = $value;
        }
        $query .= ")";
        if ($certo) {
            try {
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
                $lastId = MySql::conectar()->lastInsertId();
                $sql = MySql::conectar()->prepare("UPDATE `$nomeTabela` SET order_id = ? WHERE id = $lastId");
                $sql->execute(array($lastId));
            } catch (PDOException $e) {
                error_log("Erro ao inserir dados: " . $e->getMessage());
                return false;
            }
        }
        return $certo;
    }

    // Obtém todos os dados de uma tabela
    public static function getAll($tabela, $start = null, $end = null) {
        if ($start == null && $end == null)
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC");
        else
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC LIMIT $start, $end");

        $sql->execute();
        return $sql->fetchAll();
    }

    // Deleta dados de uma tabela
    public static function delete($tabela, $id = false) {
        if ($id == false) {
            $sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
            $sql->execute();
        } else {
            $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = ?");
            $sql->execute(array($id));
        }
    }

    // Redireciona para uma URL
    public static function redirect($url) {
        echo '<script>location.href="' . $url . '"</script>';
        die();
    }

    // Obtém um item específico de uma tabela
    public static function get($tabela, $query = '', $arr = null) {
        if ($query != '') {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE $query");
            $sql->execute($arr);
        } else {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
            $sql->execute();
        }
        return $sql->fetch();
    }

    // Atualiza dados em uma tabela
    public static function update($arr, $single = false) {
        $certo = true;
        $first = false;
        $nomeTabela = $arr['nomeTabela'];
        $query = "UPDATE `$nomeTabela` SET ";
        $parametros = []; // Inicializa o array de parâmetros
        foreach ($arr as $key => $value) {
            $nome = $key;
            if ($nome == 'acao' || $nome == 'nomeTabela' || $nome == 'id')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }
            if ($first == false) {
                $first = true;
                $query .= "$nome=?";
            } else {
                $query .= ",$nome=?";
            }
            $parametros[] = $value;
        }
        if ($certo) {
            try {
                if ($single == false) {
                    $parametros[] = $arr['id'];
                    $sql = MySql::conectar()->prepare($query . ' WHERE id = ?');
                    $sql->execute($parametros);
                } else {
                    $sql = MySql::conectar()->prepare($query);
                    $sql->execute($parametros);
                }
            } catch (PDOException $e) {
                error_log("Erro ao atualizar dados: " . $e->getMessage());
                return false;
            }
        }
        return $certo;
    }

    // Reordena itens em uma tabela
    public static function orderItem($tabela, $orderType, $id) {
        if ($orderType == 'up') {
            $infoItemAtual = Painel::get($tabela, 'id=?', array($id)); // Corrigido o uso da variável
            $order_id = $infoItemAtual['order_id'];
            $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
            $itemBefore->execute();
            if ($itemBefore->rowCount() == 0)
                return;
            $itemBefore = $itemBefore->fetch();
            Painel::update(array('nomeTabela' => $tabela,
                                'id' => $itemBefore['id'],
                                'order_id' => $infoItemAtual['order_id']));
            Painel::update(array('nomeTabela' => $tabela,
                                'id' => $infoItemAtual['id'],
                                'order_id' => $itemBefore['order_id']));
        } else if ($orderType == 'down') {
            $infoItemAtual = Painel::get($tabela, 'id=?', array($id)); // Corrigido o uso da variável
            $order_id = $infoItemAtual['order_id'];
            $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
            $itemBefore->execute();
            if ($itemBefore->rowCount() == 0)
                return;
            $itemBefore = $itemBefore->fetch();
            Painel::update(array('nomeTabela' => $tabela,
                                'id' => $itemBefore['id'],
                                'order_id' => $infoItemAtual['order_id']));
            Painel::update(array('nomeTabela' => $tabela,
                                'id' => $infoItemAtual['id'],
                                'order_id' => $itemBefore['order_id']));
        }
    }
}
?>