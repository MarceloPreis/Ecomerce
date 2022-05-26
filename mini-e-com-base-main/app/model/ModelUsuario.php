<?php

namespace App\Model;

use App\Db\Connection;

class ModelUsuario extends ModelPadrao {
    function getTable()
    {
        return "TBusuario";
    }

    function insertUsuario($aValues){
        return parent::insert($aValues);
    }

    function verificaLoginSenha($login, $senha){
        $oConnection = Connection::get();

        $sSql = 'SELECT * FROM tbusuario WHERE USULOGIN ='. "'$login'" . 'AND USUSENHA ='. "'$senha'";
        $result = pg_query($oConnection, $sSql);
        $log = pg_fetch_assoc($result);


        if (!$log){
            return false;
        }

        return true ;
    }

    function getTipo($login){
        $oConnection = Connection::get();
        $sSql = 'SELECT * FROM tbusuario WHERE USULOGIN ='. "'$login'" . 'AND USUTIPO ='."1 ";

        $result = pg_query($oConnection, $sSql);
        $log = pg_fetch_assoc($result);

        if (!$log){
            return 1;
        }
        return 0;
    }

    
}   

