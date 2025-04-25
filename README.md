# 📘 Desafio Técnico - INFOIDEIAS

Este projeto foi desenvolvido como parte do desafio técnico da empresa **INFOIDEIAS**. O objetivo foi criar, em até 6 horas, um sistema web completo (frontend + backend) utilizando **PHP puro**, que utilize:

---

## 🏠 CRUD de Imóveis

Cada imóvel contém os seguintes dados:

- Tipo (Casa, Apartamento, etc.)
- Bairro
- Número de quartos
- Preço

---

## 👤 CRUD de Interesse de Clientes

Cada cliente interessado pode informar:

- Nome
- Telefone
- Tipo de imóvel desejado
- Faixa de preço (mínimo e máximo)
- Número mínimo de quartos
- Lista de bairros desejados (multi-seleção)

---

## 🔎 Sistema de Correspondência

Quando efetuar um novo cadastro de interesse, o sistema deve redirecionar para uma tela onde são exibidos os dados do interesse em conjunto com os imóveis que atendem aos critérios definidos.

---

## 🛠️ Tecnologias Utilizadas

- PHP 8.1+
- PDO (acesso ao banco de dados)
- HTML + CSS (Bootstrap 5)
- Estrutura MVC própria
- WAMP (ambiente de desenvolvimento local)

---

## ▶️ Como Executar o Projeto

### Pré-requisitos

- PHP 8.1+
- MySQL
- Servidor Apache (como XAMPP ou WAMP)
- Navegador web

### Passos para rodar localmente

1. Clone este repositório:

```bash
git clone https://github.com/eriktrs/desafio_infoideias.git
```

2. Configure o ambiente:
   - Coloque o projeto dentro do diretório do seu servidor local (ex: `C:/wamp64/www/desafio_infoideias`)
   - Crie um banco de dados chamado `desafio_infoideias`
   - Importe o arquivo `database.sql` (presente na raiz do projeto) no seu banco

3. Acesse no navegador:


## Melhorias necessárias

  - Implementação de testes automatizados
  - Uso de framework no frontend para evitar repetição de código e facilitar a manutenção
  - Adição de logs de erros para auxiliar na identificação e solução de problemas
  - Adição da página de edição dos Interesses dos clientes
  - Adição de proteções contra SQL Injection
  - Criação de Usuários
  - Autenticação de Usuários
  - Criação de Níveis de Acesso
---

## 📣 Contato

Sinta-se à vontade para abrir uma issue ou pull request se quiser contribuir ou relatar algum problema.

---
