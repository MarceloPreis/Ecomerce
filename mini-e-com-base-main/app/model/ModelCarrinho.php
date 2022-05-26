<?php

namespace App\Model;

use App\Client\Session;
use App\Db\Connection;
use App\Model\ModelPadrao;

class ModelCarrinho extends ModelPadrao
{
    public $id;

    function getWithLogin($sLogin){
        $oConnection = Connection::get();

        $sSelect = 'SELECT *
                      FROM tbcarrinho
                      INNER JOIN tbproduto 
                        ON tbproduto.procodigo = tbcarrinho.procodigo
                     WHERE usulogin = ' . "'$sLogin'";

        $oResult = pg_query($oConnection, $sSelect);

        $aData = [];
        while ($aResult = pg_fetch_assoc($oResult)) {
            $aData[] = $aResult;
        }

        return $aData;
    }

    function getTable()
    {
        return 'tbcarrinho';
    }

    function deleteProduto()
    {
        new Session;
        $iId = $this->id;
        return parent::delete([
            'procodigo' => $iId,
            'usulogin' => "'$_SESSION[usulogin]'"
        ]);
    }

    function insertProdutos($aValues)
    {
        return parent::insert($aValues);
    }


    protected function getBdValue($xValue)
    {
        if (!empty($xValue) || !is_null($xValue)) {
            if (is_string($xValue)) {
                return '\'' . pg_escape_string($xValue) . '\'';
            }

            return $xValue;
        }

        return 'NULL';
    }
}
