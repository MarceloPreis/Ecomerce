<?php

namespace App\Model;

use App\Db\Connection;
use App\Model\ModelPadrao;

class ModelProduto extends ModelPadrao
{
    public $id;

    function getWithId($iId)
    {
        $oConnection = Connection::get();

        $sSelect = 'select * from ' . $this->getTable() . ' where procodigo = ' . $iId;

        $oResult = pg_query($oConnection, $sSelect);

        while ($aResult = pg_fetch_assoc($oResult)) {
            $aData[] = $aResult;
        }

        return $aData;
    }

    function getTable()
    {
        return 'tbproduto';
    }

    function deleteProduto()
    {
        $iId = $this->id;
        return parent::delete([
            'procodigo' => $iId
        ]);
    }

    function filter($text, $cat)
    {
        $oConnection = Connection::get();
        $sSelect = 'SELECT * FROM ' . $this->getTable() . ' WHERE PRONOME LIKE ' . "'%$text%'";
        if(!empty($cat)) $sSelect .= ' AND CATCODIGO =' . $cat;
        
        $oResult = pg_query($oConnection, $sSelect);
        $aData = [];
        while ($aResult = pg_fetch_assoc($oResult)) {
            $aData[] = $aResult;
        }
        return $aData;
    }

    static function getCats()
    {
        $oConnection = Connection::get();

        $sSelect = 'select * from tbcategoria';

        $oResult = pg_query($oConnection, $sSelect);
        $aData = [];
        while ($aResult = pg_fetch_assoc($oResult)) {
            $aData[] = $aResult;
        }
        return $aData;
    }

    function insertProdutos($aValues)
    {
        return parent::insert($aValues);
    }

    function update($aValues, $aWhere)
    {
        return parent::update($aValues, $aWhere);
    }

    /**
     * Retorna o valor pronto para ser 
     * adicionado no comando SQL
     * @param mixed $xValue
     * @return mixed
     */
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
