-- Criação do banco
CREATE DATABASE IF NOT EXISTS desafio_infoideias DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE desafio_infoideias;

-- Tabela de imóveis
CREATE TABLE imoveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    quartos INT NOT NULL DEFAULT 0,
    preco DECIMAL(12,2) NOT NULL CHECK (preco > 0),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de interesses
CREATE TABLE interesses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    tipo_desejado VARCHAR(50) NOT NULL,
    preco_min DECIMAL(12,2),
    preco_max DECIMAL(12,2),
    quartos_min INT DEFAULT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela intermediária para bairros desejados (relacionamento N:N)
CREATE TABLE interesse_bairros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    interesse_id INT NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    FOREIGN KEY (interesse_id) REFERENCES interesses(id) ON DELETE CASCADE
);

