<?php

namespace App\Controller;

use App\Controller\ControllerPadrao;
use App\View\ViewProdutos;
use App\Model\ModelProduto;
use App\View\ViewForm;

class ControllerProdutos extends ControllerPadrao
{
    function processPage()
    {
        $oModelProduto = new ModelProduto;

        if (isset($_GET['search']) || isset($_GET['catcodigo'])){
            $aSearch = $_GET['search'] ??= '';
            $iCatCodigo = $_GET['catcodigo'] ??= '';
            $a = $oModelProduto->filter($aSearch, $iCatCodigo);
        }else{
            $a = $oModelProduto->getAll();
        }

        $sTitle = 'Produtos';
        if (empty($a)) {
            $sContent = ViewProdutos::render([
                'gridProdutos' => '<h2>Não há produtos cadastrados  </h2>'
            ]);
        }else{
            $cats = $oModelProduto->getCats();
            $sContent = ViewProdutos::render([
                'selectCats' => ViewForm::catOps($cats, ''),
                'gridProdutos' => ViewProdutos::gridProdutos($a)
            ]);
        }

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }
}
