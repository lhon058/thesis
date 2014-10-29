<?php

// double check kung nakaconnect na an database


/**
 *  Includes all the database basic functions like (Fetching results, updating ,deleting, etc)
 */

if(isset($connect) && !empty($connect) || isset($GLOBALS['db']))
{


	// query function
	// pasa mo lang an query mo ex. 
	// value sin query na variable = "SELECT * FROM `faculty` "
	// tapos mareturn na cya sin result na array 
	function db_query($query)
	{
		$connect = $GLOBALS['db'];
		$result = mysqli_query($connect,$query);

		
		if($num_of_rows = mysqli_num_rows($result))
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$final_result[] = $row;
			}
			return $final_result;
		}
		else
		{
			return false;
		}

		
	}

	// delete function
	// pasa mo ang
	// 	Una : nano na table an may idedelete ka 
	// 	Second : array baga 
	// 			 an una na sulod sin array qng nano na field name eg. `firstname` na field name
	// 			 pang duwa an operator eg. "=", ">", "<" , "!="
	// 			 pang tulo ang value na pangcheck 
	// 			 example qn gagamiton ko an function 
	// 			 		db_delete("student",array("firstname","=",$value)) where $value = "Daryll"
 	function db_delete($table_name,$condition = array())
	{
		// validate all input first para sigurado
		$connect = $GLOBALS['db'];
		if(!empty($table_name) && count($condition) == 3)
		{
			$fieldname = $count[0];
			$operator  = $count[1];
			$value     = $count[2];

			$query = "DELETE FROM `$table_name` WHERE `$fieldname` $operator '$value'";

			if(db_query($query))
			{
				return true;
			}
			else
			{
				return false;
			}



		}
	}




}

?>