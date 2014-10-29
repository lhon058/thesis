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


	// sample insert value
	// an paginsert padi insusulod ko lang sa array
	// an array
	// 	sa left side an field name or column name
	// 	sa right an value na gusto mo iinsert
	// 	tapos gahuyon mo lang an db_insert("table_name ex. student", array() ex. $insert_values);
	


	// comment ko muna ini intiro kay kapag inrerefresh ko tuda 
	// lang insert kaipuhan pa pangvalidate qng may kapareho na
	/*
	$insert_values = array
				    (
				    	"FName" => "Marlon",
				    	"MName"  => "E.",
				    	"LName"  => "Decano",
				    	"FullName" => "Marlon Decano",
				    	"StudentNo" => "11-????"

				    );
	db_insert("student",$insert_values);
	*/

?>