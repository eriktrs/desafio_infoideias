<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

class Interesse
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    // Método para buscar todos os interesses no banco de dados
    public function todos()
    {
        // Retorna todos os interesses do banco de dados, ordenados por ID em ordem decrescente
        return $this->conn->query("SELECT * FROM interesses ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar os bairros vinculados aos imóveis
    public function getInteresseBairros()
    {
        // Consulta SQL para obter todos os interesses com os bairros associados
        $sql = "
         SELECT 
             interesse_bairros.interesse_id, 
             interesse_bairros.bairro
         FROM interesses
         INNER JOIN interesse_bairros ON interesse_bairros.interesse_id = interesses.id
         ORDER BY interesses.id;";

        // Executa a consulta SQL
        $stmt = $this->conn->query($sql);

        // Retorna os resultados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Método para salvar um novo interesse no banco de dados
    public function salvar($dados)
    {
        // Prepara a consulta SQL para inserir um novo interesse no banco de dados
        $stmt = $this->conn->prepare("
            INSERT INTO interesses (nome, telefone, tipo_desejado, preco_min, preco_max, quartos_min)
            VALUES (:nome, :telefone, :tipo, :min, :max, :quartos)
        ");

        // Executa a consulta com os dados fornecidos
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':telefone' => $dados['telefone'],
            ':tipo' => $dados['tipo_desejado'],
            ':min' => $dados['preco_min'] ?: null,
            ':max' => $dados['preco_max'] ?: null,
            ':quartos' => $dados['quartos_min'] ?: null,
        ]);

        // Obtém o ID do último interesse inserido
        $id = $this->conn->lastInsertId();

        // Se houver bairros desejados, insere-os na tabela de interesse_bairros
        if (!empty($dados['bairros'])) {
            foreach ($dados['bairros'] as $bairro) {
                $stmtBairro = $this->conn->prepare("INSERT INTO interesse_bairros (interesse_id, bairro) VALUES (?, ?)");
                $stmtBairro->execute([$id, $bairro]);
            }
        }

        // Retorna o ID do interesse inserido
        return $id;
    }

    // Método para buscar um interesse específico pelo ID
    public function procurar($id)
    {
        // Prepara a consulta SQL para buscar um interesse específico pelo ID
        $stmt = $this->conn->prepare("SELECT * FROM interesses WHERE id = ?");
        $stmt->execute([$id]);
        $interesse = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se o interesse não for encontrado, retorna null
        if (!$interesse) {
            return null; // Retorna null se o interesse não for encontrado
        }

        // Prepara a consulta SQL para buscar os bairros associados ao interesse
        $stmt2 = $this->conn->prepare("SELECT bairro FROM interesse_bairros WHERE interesse_id = ?");
        $stmt2->execute([$id]);
        $interesse['bairros'] = array_column($stmt2->fetchAll(PDO::FETCH_ASSOC), 'bairro');

        // Retorna o interesse encontrado, incluindo os bairros associados
        return $interesse;
    }

    // Método para buscar imóveis compatíveis com o interesse
    public function buscarImoveisCompativeis($interesse)
    {
        // Prepara a consulta SQL para buscar imóveis compatíveis com o interesse
        $sql = "SELECT * FROM imoveis WHERE tipo = :tipo";
        $params = [':tipo' => $interesse['tipo_desejado']];

        // Adiciona condições à consulta com base nos critérios do interesse
        if ($interesse['preco_min']) {
            $sql .= " AND preco >= :min";
            $params[':min'] = $interesse['preco_min'];
        }

        if ($interesse['preco_max']) {
            $sql .= " AND preco <= :max";
            $params[':max'] = $interesse['preco_max'];
        }

        if ($interesse['quartos_min']) {
            $sql .= " AND quartos >= :quartos";
            $params[':quartos'] = $interesse['quartos_min'];
        }

        if (!empty($interesse['bairros'])) {
            $in = implode(',', array_fill(0, count($interesse['bairros']), '?'));
            $sql .= " AND bairro IN ($in)";
            $params = array_merge($params, $interesse['bairros']);
        }

        // Prepara e executa a consulta SQL
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($params));

        // Retorna os imóveis compatíveis encontrados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para atualizar um interesse existente no banco de dados
    public function atualizar($id, $data)
    {
        // Prepara a consulta SQL para atualizar um interesse específico pelo ID
        $stmt = $this->conn->prepare("
            UPDATE interesses SET nome = ?, telefone = ?, tipo_imovel = ?, preco_min = ?, preco_max = ?, quartos = ?, bairros = ?
            WHERE id = ?
        ");

        // Executa a consulta com os dados fornecidos
        return $stmt->execute([
            $data['nome'],
            $data['telefone'],
            $data['tipo_desejado'],
            $data['preco_min'] ?? null,
            $data['preco_max'] ?? null,
            $data['quartos'] ?? null,
            $data['bairros'] ?? null,
            $id
        ]);
    }

    // Método para remover um interesse específico pelo ID
    public function remover($id)
    {
        // Prepara a consulta SQL para remover um interesse específico pelo ID
        $stmt = $this->conn->prepare("DELETE FROM interesses WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
