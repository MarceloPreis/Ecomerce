<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;

class ViewAdmin extends ViewPadrao
{
    static function tableProdutos(array $data)
    {
       $sTable = '';

       foreach($data as $c){
        $sTable .= '   
            <tr>
                <td>' . $c['procodigo'] . '</td>
                <td> <img src="img/' . $c['proimg'] . '.jpg" width="80" height="60"></td>
                <td>' . $c['pronome'] . '</td>
                <td>' . $c['propreco'] . '</td>
                <td><a href=' . "'index.php?pg=form&procodigo=$c[procodigo]'" . '><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href=' . "'index.php?pg=admin&act=delete&procodigo=$c[procodigo]'" . '><i class="fa-solid fa-trash"></i></a></td>
            </tr>';
       }
       return $sTable;
    }
}