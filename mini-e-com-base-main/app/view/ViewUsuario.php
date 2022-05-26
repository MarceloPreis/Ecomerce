<?php

namespace App\View;

use App\View\ViewPadrao;
use App\Controller\ControllerPadrao;

class ViewUsuario extends ViewPadrao
{
    static function checkAdmin(){
        return '<div class="mb-3 form-check">
                    <input type="hidden" name="usutipo" value="0" />
                    <input type="checkbox" class="form-check-input" id="adminCheck" name="usutipo" value="1">
                    <label class="form-check-label" for="adminCheck">Administrador</label>
                </div>';
    }
}