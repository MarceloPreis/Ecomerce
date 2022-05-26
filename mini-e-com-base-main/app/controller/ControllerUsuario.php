<?php

namespace App\Controller;

use App\Controller\ControllerPadrao;
use App\View\ViewUsuario;
use App\View\ViewPage;
use App\View\ViewProdutos;
use App\Model\ModelUsuario;

class ControllerUsuario extends ControllerPadrao
{

    function processPage()
    {
        $sContent = ViewUsuario::render([
            'msgCadastro' => '',
            'checkAdmin' => ViewUsuario::checkAdmin()
        ]);

        $sTitle = 'Cadastro de Usuario';

        $this->footerVars = [
            // Passar aqui os parametros do footer da página
            'footerContent' => '<h5>Welcome!</h5>'
        ];

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }

    function processInsert()
    {
        $a = [
            'usulogin' => $_POST['usulogin'],
            'ususenha' => $_POST['ususenha'],
            'usutipo' => $_POST['usutipo']
        ];
        (new ModelUsuario)->insertUsuario($a);

        return (new ControllerLogin)->processPage();
    }
}