<?php
namespace App\Core;

class EnvLoader
{
    public static function load($path)
    {
        // Verifica se o arquivo existe 
        if (!file_exists($path)) {
            return;
        }

        // Atribuindo o conteúdo do arquivo a uma variável
        // Ignorando linhas vazias e linhas que começam com '#'
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Carregando as variáveis de ambiente
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) continue;

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_ENV)) {
                $_ENV[$name] = $value;
                putenv("$name=$value");
            }
        }
    }
}
