<?php

namespace App\Controller;

use App\Client\Session;
use App\Controller\ControllerPadrao;
use App\View\ViewProdutos;
use App\Db\Connection;
use App\Model\ModelCarrinho;
use App\View\ViewCarrinho;

class ControllerCarrinho extends ControllerPadrao
{
    function processPage()
    {
        $oModelCarrinho = new ModelCarrinho;
        new Session;
        $sTitle = 'Carrinho';

        if (isset($_SESSION['usulogin'])) {

            $sLogin = $_SESSION['usulogin'] ??= '';

            $a = $oModelCarrinho->getWithLogin($sLogin);

            if (empty($a)) {
                $sContent = ViewCarrinho::render([
                    'tabelaCarrinho' => '<h2>Não há produtos em seu carrinho!</h2>'
                ]);
            } else {
                $sContent = ViewCarrinho::render([
                    'tabelaCarrinho' => ViewCarrinho::tableProdutos($a)
                ]);
            }
        }else{
            $sContent = ViewCarrinho::render([
                'tabelaCarrinho' => '<h2>Faça Login</h2>'
            ]);
        }

        if(empty($this->footerVars)) $this->footerVars = ['footerContent' => '<h5> Este é o seu carrinho de compras</h5>'];

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }

    function processDelete()
    {
        $iIdProduto = $_GET['procodigo'] ??= '';

        $oModelCarrinho = new ModelCarrinho;
        $oModelCarrinho->id = $iIdProduto;

        if (!$oModelCarrinho->deleteProduto()) {
            $this->footerVars = [
                'footerContent' =>
                '<div class="alert alert-danger" role="alert">
                    Produto não pode ser excluído 
                </div>'
            ];
        } else {
            $this->footerVars = [
                'footerContent' =>
                '<div class="alert alert-success" role="alert">
                    Produto excluído do carrinho
                </div>'
            ];
        }

        return $this->processPage();
    }

    function processInsert()
    {
        $iIdProduto = $_GET['procodigo'] ??= '';
        new Session;

        $a = [
            'usulogin' => $_SESSION['usulogin'],
            'procodigo' => $iIdProduto
        ];

        (new ModelCarrinho)->insertProdutos($a);

        return $this->processPage();

    }
}
