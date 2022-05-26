<?php

namespace App\Model;

use App\Db\Connection;

abstract class ModelPadrao
{
    abstract function getTable();

    function getAll()
    {
        $oConnection = Connection::get();

        $sSelect = 'select * from ' . $this->getTable();

        $oResult = pg_query($oConnection, $sSelect);
        $aData = [];
        while ($aResult = pg_fetch_assoc($oResult)) {
            $aData[] = $aResult;
        }
        return $aData;
    }

    protected function insert($aValues)
    {
        $oConnection = Connection::get();

        foreach($aValues as $col => $value){
            $colunas[] = $col;
            $valores[] = is_numeric($value) ? $value : "'$value'";
        }

        $sSql = "INSERT INTO " . $this->getTable() . " (" . implode(",", $colunas) . ") VALUES (" . implode(",", $valores) . ")";

        return (pg_query($oConnection, $sSql));   
    }

    protected function delete($aWhere)
    {
        $oConnection = Connection::get();

        $sSql = 'DELETE FROM ' . $this->getTable() . ' WHERE 1=1';
        
        foreach ($aWhere as $col => $value){
            $sSql .= " AND $col = $value ";
        }

        $result = pg_query($oConnection, $sSql);

        if (!$result){
            return false;
        }
        return true;
    }

    protected function update($aValues, $aWhere)
    {
        $oConnection = Connection::get();
        $sSql = 'UPDATE ' . $this->getTable() . ' SET ';

        $sValues ='';
        foreach($aValues as $col => $value){
            $sValues .= " $col = '$value',";
        }
        $sValues = substr($sValues,0,-1);

        $sSql .=  $sValues . ' WHERE 1=1 ';

        foreach ($aWhere as $c){
            $sSql .= "AND $c[col] = $c[value] ";
        }
        $result = pg_query($oConnection, $sSql);

        if (!$result){
            return false;
        }
        return true;
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
