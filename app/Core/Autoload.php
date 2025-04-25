<?php

spl_autoload_register(function ($class) {
    // Define o prefixo do namespace base
    $prefix = 'App\\';

    // Define o diretório base onde as classes estão localizadas
    $base_dir = __DIR__ . '/../';

    // Verifica se a classe usa o namespace base
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar, não faz nada
        return;
    }

    // Pega o nome relativo da classe
    $relative_class = substr($class, $len);

    // Constrói o caminho completo do arquivo
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Se o arquivo existir, inclui ele
    if (file_exists($file)) {
        require $file;
    }
});
