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
    public function procurar($id)
    {
        // Prepara a consulta SQL para buscar um imóvel específico pelo ID
        $stmt = $this->conn->prepare("SELECT * FROM imoveis WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para salvar um imóvel específico pelo ID
    public function salvar($dados)
    {
        // Prepara a consulta SQL para inserir um novo imóvel no banco de dados
        $stmt = $this->conn->prepare("
            INSERT INTO imoveis (tipo, bairro, quartos, preco)
            VALUES (:tipo, :bairro, :quartos, :preco)
        ");

        // Executa a consulta com os dados fornecidos
        $stmt->execute([
            ':tipo' => $dados['tipo'],
            ':bairro' => $dados['bairro'],
            ':quartos' => $dados['quartos'],
            ':preco' => $dados['preco']
        ]);
    }

    // Método para atualizar um imóvel existente no banco de dados
    public function atualizar($id, $data)
    {
        // Prepara a consulta SQL para atualizar um imóvel específico pelo ID
        $stmt = $this->conn->prepare("UPDATE imoveis SET tipo = ?, bairro = ?, quartos = ?, preco = ? WHERE id = ?");

        // Executa a consulta com os dados fornecidos
        return $stmt->execute([
            $data['tipo'],
            $data['bairro'],
            $data['quartos'],
            $data['preco'],
            $id
        ]);
    }

    public function remover($id)
    {
        // Prepara a consulta SQL para remover um imóvel específico pelo ID
        $stmt = $this->conn->prepare("DELETE FROM imoveis WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
