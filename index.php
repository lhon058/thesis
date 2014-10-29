<?php

	include_once("db_connect.php");


	$results = db_query("SELECT * FROM `signup`");

	if($results)
	{	
		echo "<table border = '1'>";
		foreach ($results as $result) 
		{
			//convert nato sa object para madali pagkuwa value
			$result = (object)$result;

			echo "<tr> <td> $result->username </td>
					   <td> $result->firstname </td>
					   <td> $result->lastname </td>
				  </tr>	";
		}
	}

?>