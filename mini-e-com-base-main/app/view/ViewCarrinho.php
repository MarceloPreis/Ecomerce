<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;

class ViewCarrinho extends ViewPadrao
{
    static function tableProdutos(array $data)
    {
       $sTable = '';

       foreach($data as $c){
        $sTable .= '   
            <tr onclick=>
                <td>' . $c['procodigo'] . '</td>
                <td> <img src="img/' . $c['proimg'] . '.png" width="80" height="60"></td>
                <td>' . $c['pronome'] . '</td>
                <td>' . $c['propreco'] . '</td>
                <td><a href=' . "'index.php?pg=carrinho&act=delete&procodigo=$c[procodigo]'" . '><i class="fa-solid fa-trash"></i></a></td>
            </tr>';
       }
       return $sTable;
    }
}