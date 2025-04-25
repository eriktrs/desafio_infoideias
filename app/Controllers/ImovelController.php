<?php
namespace App\Controllers;

use App\Models\Imovel;
use App\Core\Controller;

class ImovelController extends Controller
{
    // Método para listar todos os imóveis
    public function index()
    {
        $model = new Imovel();
        $imoveis = $model->todos();
        $this->view('imoveis/index', ['imoveis' => $imoveis]);
    }

    // Método para exibir o formulário de criação de um novo imóvel
    public function create()
    {
        $this->view('imoveis/create');
    }

    // Método para salvar um novo imóvel no banco de dados
    public function store()
    {
        $model = new Imovel();
        $model->salvar($_POST);
        header('Location: desafio_infoideias/');
    }

    // Método para exibir o formulário de edição de um imóvel existente
    public function edit($id)
    {
        $model = new Imovel();
        $imovel = $model->procurar($id);
        $this->view('imoveis/edit', ['imovel' => $imovel]);
    }

    // Método para atualizar um imóvel existente no banco de dados
    public function update($id)
    {
        $model = new Imovel();
        $model->atualizar($id, $_POST);
        header('Location: /desafio_infoideias/Imovel/index');
        exit;
    }

    // Método para excluir um imóvel do banco de dados
    public function delete($id)
    {
        $model = new Imovel();
        $model->remover($id);
        header('Location: /desafio_infoideias/Imovel/index');
        exit;
    }

}
