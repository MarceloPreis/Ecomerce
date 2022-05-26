<?php

namespace App\Controller;

use App\Client\Session;
use App\Controller\ControllerPadrao;
use App\Controller\ControllerProdutos;
use App\View\ViewLogin;
use App\Model\ModelUsuario;

class ControllerLogin extends ControllerPadrao
{

    function processPage()
    {
        $oSession = new Session;

        if($oSession->isLogged()){
            $oSession->logout();

            $oControllerProduto = new ControllerProdutos;
            $oControllerProduto->footerVars = [
                'footerContent' => '
                <div class="alert alert-success" role="alert">
                    Logout efetuado com sucesso!
                </div>'
            ];

            return $oControllerProduto->processPage();
        }

        $sContent = ViewLogin::render([
            'msgCadastro' => ViewLogin::msgCadastro(),
            'checkAdmin' => ''
        ]);

        $sTitle = 'Cadastro de Usuario';

        return parent::getPage(
            $sTitle,
            $sContent
        );
    }

    function processLogin(){

        $login = $_POST['usulogin'];
        $senha = $_POST['ususenha'];
        
        $oModelUsuario = new ModelUsuario;

        if ($oModelUsuario->verificaLoginSenha($login, $senha)){
            $session = new Session;
            $session->login($login);
            $_SESSION['usutipo'] =  $oModelUsuario->getTipo($login);
            $oControllerProduto = new ControllerProdutos;

            $oControllerProduto->footerVars = [
                'footerContent' => '
                <div class="alert alert-success" role="alert">
                    Login efetuado com sucesso!
                </div>
              '
            ];
            return ($oControllerProduto)->processPage();
        }else{
            $this->footerVars = [
                'footerContent' => '
                <div class="alert alert-danger" role="alert">
                    Erro! Login ou senha inválidos!
                </div>'
            
            ];

            return $this->processPage();
        }  
    }
}