<?php
class MySql
{
    private static $pdo;

    // Método estático para conectar ao banco de dados
    public static function conectar(): ?PDO
    {
        // Verifica se a conexão já foi estabelecida
        if (self::$pdo === null) {
            try {
                // Tenta criar uma nova conexão PDO
                self::$pdo = new PDO(
                    'mysql:host=' . HOST . ';dbname=' . DATABASE,
                    USER,
                    PASSWORD,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
                // Define o modo de erro para exceções
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // Registra a mensagem de erro para depuração
                error_log('Erro de conexão: ' . $e->getMessage());
                echo '<h2> Não foi possível conectar! </h2>';
                return null; // Retorna null em caso de falha
            }
        }
        return self::$pdo; // Retorna a instância PDO
    }
}