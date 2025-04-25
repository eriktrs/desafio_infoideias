<?php
namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    // Variável estática para armazenar a instância da conexão
    private static $instance;

    // Método para obter a instância da conexão com o banco de dados
    public static function getConnection()
    {
        // Verifica se a instância já foi criada
        if (!self::$instance) {
            $dotenvPath = dirname(__DIR__, 2);

            // Carrega as variáveis de ambiente do arquivo .env
            if (file_exists("$dotenvPath/.env")) {
                $lines = file("$dotenvPath/.env", FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    if (strpos(trim($line), '#') === 0 || !strpos($line, '=')) continue;
                    putenv(trim($line));
                }
            }

            // Obtém as variáveis de ambiente
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            // Tenta criar a conexão com o banco de dados
            // Se falhar, exibe uma mensagem de erro
            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
