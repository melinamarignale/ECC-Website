<?php
class doDBUtils
{

	function doDBUtils()
	{

	}

	/*
	 * Creation d'une requete insert à partir d'un tableau
	 */
	static function createInsertFromArray($tab, $table ='')
	{

		$aField = array();
		$aValues = array();

		foreach($tab as $key => $value)
		{
			$aField[] = '`'.$key.'`';
			$aValues[] = "'".addslashes($value)."'";
		}

		$sql = "INSERT into $table ( ".implode(" , " , $aField).") VALUES (".implode(" , " , $aValues)." ) ";

		return $sql;


	}

}