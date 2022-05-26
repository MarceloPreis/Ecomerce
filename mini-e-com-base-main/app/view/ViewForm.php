<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;
use App\Controller\ControllerForm;

class ViewForm extends ViewPadrao
{
    static function catOps(array $a, $selected)
    {
        $sOps = ' <option value="" disabled selected>Selecione</option>';
        foreach ($a as $c) {
            if ($c['catcodigo'] == $selected) $selected = 'selected';
            $sOps .= '<option value="' . $c['catcodigo'] . '"' . $selected . '>' . $c['catdescricao'] . '</option>';
        }

        return $sOps;
    }

    static function form(array $a, $act){

        return '
        
            <form action="index.php?pg=form&act='.$act.'" method="post">
            <div class="form-row">
                <div class="form-group col-md-1">
                <label for="procodigo">Código</label>
                <input type="number" class="form-control" id="pronome" name="procodigo" value="' . $a[0]['procodigo'] . '" readonly>
                </div>
                <div class="form-group col-md-5">
                <label for="pronome">Título do produto</label>
                <input type="text" class="form-control" id="pronome" name="pronome" placeholder="Título" value="' . $a[0]['pronome'] . '">
                </div>
                <div class="form-group col-md-4">
                <label for="propreco">Valor</label>
                <input type="text" class="form-control" id="propreco" name="propreco" placeholder="R$"
                    onKeyUp="mascaraMoeda(this, event)" value="'. str_replace(".",",",$a[0]['propreco']).'">
                </div>
                <div class="form-group col-md-2">
                <label for="proimg">Imagem</label>
                <input type="text" class="form-control" id="proimg" name="proimg" value="' . $a[0]['proimg'] . '">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                <label for="prodescricao">Descrição do Produto</label>
                <textarea class="form-control" id="prodescricao" name="prodescricao">' . $a[0]['prodescricao'] . '</textarea>
                </div>
                <div class="form-group col-md-4">
                <label for="catcodigo">Categorias</label>
                <select name="catcodigo" id="" class="form-control">
                    {{catOps}}
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        ';
    }
}
