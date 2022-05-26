<?php

/**
 * Rederiza o conteúdo da página solicitada
 * @param string $sPage
 * @return string
 */
function render($sPage)
{
    switch ($sPage) {
        case 'produtos':
            return (new App\Controller\ControllerProdutos)->render();
            break;
        case 'admin':
            return (new App\Controller\ControllerAdmin)->render();
            break;
        case 'form':
            return (new App\Controller\ControllerForm)->render();
            break;
        case 'login':
            return (new App\Controller\ControllerLogin)->render();
            break;
        case 'usuario':
            return (new App\Controller\ControllerUsuario)->render();
            break;
        case 'carrinho':
            return (new App\Controller\ControllerCarrinho)->render();

        
    }

    return 'Página não encontrada!';
}
