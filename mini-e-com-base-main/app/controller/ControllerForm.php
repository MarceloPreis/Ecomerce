<?php

namespace App\Controller;

use App\Controller\ControllerPadrao;
use App\View\ViewProdutos;
use App\Db\Connection;
use App\Model\ModelCadastro;
use App\Model\ModelProduto;
use App\View\ViewForm;
use App\View\ViewPage;

class ControllerForm extends ControllerPadrao
{
    function processPage()
    {
        $sTitle = 'Cadastro';
        $oModelProduto = new ModelProduto;

        if (isset($_GET['procodigo'])){
            $produto = $oModelProduto->getWithId(($_GET['procodigo']));
            $act = 'update';
        }else{
            $produto[0]['procodigo'] ='';
            $produto[0]['pronome'] = '';
            $produto[0]['propreco'] = '';
            $produto[0]['proimg'] = '';
            $produto[0]['prodescricao'] = '';
            $produto[0]['catcodigo'] = '';
            $act = 'insert';
        };
        $cats = $oModelProduto->getCats();
        $sContent = ViewForm::render([
            'form' => ViewForm::form($produto, $act),
            'catOps' => ViewForm::catOps($cats, $produto[0]['catcodigo'])
        ]);

        if(empty($this->footerVars)) $this->footerVars = ['footerContent' => '<h2>Cadastro/Edição de produtos</h2>'];

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }


    function processInsert()
    {
        $a = [
            'pronome' => $_POST['pronome'],
            'prodescricao' => $_POST['prodescricao'],
            'propreco' => floatval(str_replace(",", ".",$_POST['propreco'])),
            'proimg' => $_POST['proimg'],
            'catcodigo' => $_POST['catcodigo']
        ];

        (new ModelProduto)->insertProdutos($a);
        return (new ControllerAdmin)->processPage();
    }

    function processUpdate()
    {
        $aValues = [
            'pronome' => $_POST['pronome'],
            'prodescricao' => $_POST['prodescricao'],
            'propreco' => floatval(str_replace(",", ".",$_POST['propreco'])),
            'proimg' => $_POST['proimg'],
            'catcodigo' => $_POST['catcodigo']
        ];

        $aWhere = [[
            'value' => $_POST['procodigo'],
            'col' => 'procodigo'
        ]];

        echo (new ModelProduto)->update($aValues, $aWhere);

        return (new ControllerAdmin)->processPage();
    }
}
