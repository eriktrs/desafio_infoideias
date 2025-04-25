<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

class Imovel
{
    // Variável para armazenar a conexão com o banco de dados
    private $conn;

    // Construtor da classe, que inicializa a conexão com o banco de dados
    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    // Método para buscar todos os imóveis no banco de dados
    public function todos()
    {
        $stmt = $this->conn->query("SELECT * FROM imoveis");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar um imóvel específico pelo ID
    public function salvar($dados)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO imoveis (tipo, bairro, quartos, preco)
            VALUES (:tipo, :bairro, :quartos, :preco)
        ");
        $stmt->execute([
            ':tipo' => $dados['tipo'],
            ':bairro' => $dados['bairro'],
            ':quartos' => $dados['quartos'],
            ':preco' => $dados['preco']
        ]);
    }
}
