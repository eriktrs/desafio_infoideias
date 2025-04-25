<?php

namespace App\Controllers;

use App\Models\Interesse;
use App\Models\Imovel;
use App\Core\Controller;

class InteresseController extends Controller
{
    // Método para listar todos os interesses
    public function index()
    {
        $interesseModel = new Interesse();
        $imovelModel = new Imovel();

        $data = [
            'interesses' => $interesseModel->todos(),
            'bairros' => $imovelModel->getBairros(),
            'interesse_bairros' => $interesseModel->getInteresseBairros(),
        ];

        $this->view('interesses/index', $data);
    }

    // Método para exibir o formulário de criação de um novo interesse
    public function create()
    {
        $this->view('interesses/create');
    }

    // Método para salvar um novo interesse no banco de dados
    public function store()
    {
    
        if (!empty($_POST['bairros']) && is_array($_POST['bairros'])) {
            $_POST['bairros'] = implode(',', $_POST['bairros']);
        }

        $model = new Interesse();
        $id = $model->salvar($_POST);

        header("Location: match/$id");
    }

    // Método para exibir os imóveis compatíveis com o interesse
    public function match($id)
    {
        $interesseModel = new Interesse();
        $imovelModel = new Imovel();

        $interesse = $interesseModel->procurar($id);
        $imoveis = $imovelModel->match($interesse);

        $this->view('interesses/match', ['interesse' => $interesse, 'imoveis' => $imoveis]);
    }

    // Método para exibir o formulário de edição de um interesse existente
    public function edit($id)
    {
        $interesseModel = new Interesse();
        $imovelModel = new Imovel();

        $data = [
            'interesses' => $interesseModel->todos(),
            'bairros' => $imovelModel->getBairros(),
            'interesse_bairros' => $interesseModel->getInteresseBairros(),
        ];
        
        $this->view('interesses/edit', $data);
    }

    // Método para atualizar um interesse existente no banco de dados
    public function update($id)
    {
        $model = new Interesse();
        $model->atualizar($id, $_POST);
        header('Location: /desafio_infoideias/Interesse/index');
    }


    // Método para remover um interesse específico pelo ID
    public function delete($id)
    {
        $model = new Interesse();
        $model->remover($id);
        header('Location: /desafio_infoideias/Interesse/index');
    }
}
