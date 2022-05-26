<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;

class ViewAdmin extends ViewPadrao
{
    static function tableProdutos(array $data)
    {
       $sTable = '
       
       <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
        <tbody>
       ';

       foreach($data as $c){
        $sTable .= '   
                     
            <tr onclick=>
                <td>' . $c['procodigo'] . '</td>
                <td> <img src="img/' . $c['proimg'] . '.png" width="80" height="60"></td>
                <td>' . $c['pronome'] . '</td>
                <td>' . $c['propreco'] . '</td>
                <td><a href=' . "'index.php?pg=form&procodigo=$c[procodigo]'" . '><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href=' . "'index.php?pg=admin&act=delete&procodigo=$c[procodigo]'" . '><i class="fa-solid fa-trash"></i></a></td>
            </tr>';
       }

       $sTable .= '
       </tbody>
       </table>';
       return $sTable;
    }
}