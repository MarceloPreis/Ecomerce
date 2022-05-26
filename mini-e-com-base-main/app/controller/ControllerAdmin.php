<?php

namespace App\Controller;

use App\Controller\ControllerPadrao;
use App\View\ViewProdutos;
use App\Db\Connection;
use App\Model\ModelProduto;
use App\View\ViewAdmin;

class ControllerAdmin extends ControllerPadrao
{
    function processPage()
    {
        $oModelProduto = new ModelProduto;

        $a = $oModelProduto->getAll();

        $sTitle = 'Administrador';

        if (empty($a)) {
            $sContent = ViewAdmin::render([
                'gridProdutos' => '<h2>Não há produtos cadastrados</h2>'
            ]);
        }else{
            $sContent = ViewAdmin::render([
                'tableProdutos' => ViewAdmin::tableProdutos($a)
            ]);
        }

        if(empty($this->footerVars)) $this->footerVars = ['footerContent' => '<h5> Seja Bem Vindo! </h5>'];

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }

    function processDelete()
    {
        $iIdProduto = $_GET['procodigo'] ??= '';

        $oModelProduto = new ModelProduto;
        $oModelProduto->id = $iIdProduto;

        if (!@$oModelProduto->deleteProduto()) {
            $this->footerVars = [
                'footerContent' =>
                '<div class="alert alert-danger" role="alert">
                    Produto não pode ser excluído 
                </div>'
            ];
        }else{
            $this->footerVars = [
                'footerContent' =>
                '<div class="alert alert-success" role="alert">
                    Produto excluído com sucesso!
                </div>'
            ];
        }

        return $this->processPage();
    }
}
