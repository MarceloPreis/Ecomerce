<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;

class ViewProdutos   extends ViewPadrao
{
    static function gridProdutos(array $data)
    {
        $sCard = '';
        foreach ($data as $c) {
            $sCard .= '

            <div class="col">
            <div class="card">
                <img src="img/' . $c["proimg"] . '.jpg" class="card-img-top" alt="..."  style=" max-width: 100%; max-height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">' . $c['pronome'] . '</h5>
                    <h6> R$ ' . $c['propreco'] . '</h6>
                    <p class="card-text">' . $c["prodescricao"] . '</p>
                    <a href="index.php?pg=carrinho&act=insert&procodigo='. $c["procodigo"] .'"><i class="fa-solid fa-cart-plus"></i></a>
                </div>
            </div>
            </div>
        ';
        }
        return $sCard;
    }
}
